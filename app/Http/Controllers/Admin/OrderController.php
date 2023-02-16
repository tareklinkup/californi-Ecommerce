<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::withoutDeleted()->latest()->get();
        return view('admin.order.index', compact('orders'));
    }

    public function show($id) {
        $order = Order::findOrFail($id);
        $order_products = DB::table('order_product')->where('order_id', $order->id)->get();
        return view('admin.order.show', compact('order', 'order_products'));
    }

    public function invoice($id) {
        $order = Order::with('user', 'order_products')->findOrFail($id);
        $vat = Settings::first()->vat;
        return view('admin.order.invoice', compact('order', 'vat'));
    }

    public function destroy(Request $request) {
        $order = Order::findOrFail($request->id);
        $order->is_delete = 1;
        $order->save();
        $this->message('success', 'Order Cancel');        
        return redirect()->route('admin.orders');
    }

    public function processing($id) {
        $order = Order::findOrFail($id);
        $order->status = 1;
        $order->processing_at = Carbon::now();
        $order->save();

        return back();
    }

    public function delivered($id) {
        $order = Order::findOrFail($id);
        $order->status = 2;
        $order->delivered_at = Carbon::now();
        $order->save();

        return back();
    }

    public function newOrderCount() {
        return Order::where('status', 0)->latest()->count();
    }
}
