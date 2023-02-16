<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function showAdminLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.admin_login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($request->except('_token'))) {
            return redirect()->route('admin.dashboard');
        }

        Session::flash('error', 'Username or Password was incorrect.');
        return back()->withInput($request->only('username'));
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function showDashboard()
    {
        return view('admin.dashboard.dashboard', [
            'user_count' => User::count(),
            'brand_count' => Brand::withoutDeleted()->count(),
            'category_count' => Category::withoutDeleted()->count(),
            'product_count' => Product::withoutDeleted()->count(),
            'new_order_count' => Order::withoutDeleted()->where('status', 0)->count(),
            'processing_order_count' => Order::withoutDeleted()->where('status', 1)->count(),
            'complete_order_count' => Order::withoutDeleted()->where('status', 2)->count()
        ]);
    }

    public function profile() {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request) {
        $request->validate([
            'username' => 'required'
        ]);
        
        $user = Auth::guard('admin')->user();
        $user->username = $request->username;
        
        if ($request->filled('old_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                Session::flash('old_password', 'Old password was incorrect!');
                return redirect()->back();
            }

            $request->validate([
                'new_password' => 'required'
            ]);
        }

        if ($request->filled('new_password')) {
            $request->validate([
                'new_password' => 'min:6|same:confirm_password'
            ]);

            $user->password = bcrypt($request->new_password);
        }

        $user->save();

        $this->message('success', 'Admin information successfully updated.');
        return redirect()->back();
    }



    // Customer
    public function customers()
    {
        $users = User::all();
        return view('admin.customer.index', compact('users'));
    }

    // get all message 18-2-2021 (author:azhar)
    public function getAllMessage()
    {
        $messages = Message::all();
        return view('admin.message.index',compact('messages'));
    }

    public function destroyMessage(Message $message)
    {
        $message->delete();
        return redirect()->back();
    }
}
