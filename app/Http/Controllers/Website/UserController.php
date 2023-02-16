<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function profile() {
        $regions = ['dhaka', 'chittagong', 'khulna', 'barisal', 'mymensingh', 'rajshahi', 'sylhet', 'rangpur'];
        return view('pages.profile', compact('regions'));
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->region = $request->region;

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
                'new_password' => 'min:6|same:password_confirmation'
            ]);

            $user->password = bcrypt($request->new_password);
        }

        $user->save();

        $this->message('success', 'Your information successfully updated.');
        return redirect()->back();
    }
}
