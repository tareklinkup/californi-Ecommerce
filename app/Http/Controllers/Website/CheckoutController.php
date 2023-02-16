<?php

namespace App\Http\Controllers\Website;

use App\User;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function index() {
        if (!isset($_SESSION['cart'])) {
            return redirect()->route('cart');
        }
        $cart = new CartController;
        $items = $_SESSION['cart'] ?? [];
        $sub_total = $cart->getSubTotal();
        $vat = $cart->getVAT();
        $shipping_charge = Settings::first()->shipping_charge;
        $grand_total = $cart->getGrandTotal();
        $total_item = $cart->cartTotalItem();
        $regions = ['dhaka', 'chittagong', 'khulna', 'barisal', 'mymensingh', 'rajshahi', 'sylhet', 'rangpur'];
        return view('pages.checkout', compact('regions', 'items', 'sub_total', 'vat', 'shipping_charge', 'grand_total', 'total_item'));
    }

    public function orderConfirm(Request $request)
    {
        $this->validateCofirmOrderForm($request);

        $order = new Order();
        $order->order_number = $this->generateOrderNumber();
        $order->user_id = Auth::id();

        if (isset($request->same_as_account)) {
            $user = Auth::user();
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->region = $request->region;
            $user->save();
        } else {
            $order->shipping_name = $request->shipping_name;
            $order->shipping_phone = $request->shipping_phone;
            $order->shipping_address = $request->shipping_address;
            $order->shipping_region = $request->shipping_region;
        }

        $order->sub_total = $request->sub_total;
        $order->vat = $request->vat;
        $order->total = $request->grand_total;
        $order->shipping_charge = $request->shipping_charge;
        $order->payment_method = $request->payment_method;
        $order->save();

        if (is_array($request->product) && count($request->product) > 0) {
            foreach ($request->product as $id => $product) {
                DB::table('order_product')->insert([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }

        $_SESSION['order_id'] = $order->id;

        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            unset($_SESSION['cart']);
        }

        return redirect()->route('order.success');
    }

    public function checkoutSuccess() {
        $order_id = $_SESSION['order_id'] ?? '';
        if (empty($order_id)) {
            return redirect()->route('cart');
        } else {
            unset($_SESSION['order_id']);
        }
        $order = Order::findOrFail($order_id);
        return view('pages.checkout_success', compact('order'));
    }

    private function validateCofirmOrderForm($request) {
        $request->validate([
            'name' => 'required',
            'payment_method' => 'required'
        ]);

        if (isset($request->same_as_account)) {
            $request->validate([
                'phone' => 'required|numeric|min:11',
                'address' => 'required',
                'region' => 'required'
            ]);
        } else {
            $request->validate([
                'shipping_name' => 'required',
                'shipping_address' => 'required',
                'shipping_phone' => 'required|numeric|min:11',
                'shipping_region' => 'required'
            ]);
        }
    }

    private function generateOrderNumber() {
        $oldOrderNumbers = Order::pluck('order_number');
        if (count(array_filter((array) $oldOrderNumbers)) > 0) {
            if ($oldOrderNumbers->max()) {
                $oldMaxOrderNumber = preg_replace('/[A-Z]+/', '', $oldOrderNumbers->max());
                $prefix = preg_replace('/[0-9]+/', '', $oldOrderNumbers->max());
                $newOrderNumber = $prefix . ($oldMaxOrderNumber + 1);
            } else {
                $newOrderNumber = 'FK1001';
            }
        } else {
            $newOrderNumber = 'FK1001';
        }
        return $newOrderNumber;
    }

    public function orders()
    {
        $orders = Order::myOrders()->latest()->get();
        $order_number = '';
        return view('pages.orders', compact('orders', 'order_number'));
    }

    public function order($order_number) {
        $orders = Order::myOrders()->latest()->get();
        $order = Order::where('order_number', strtoupper($order_number))->withoutDeleted()->first();
        return view('pages.orders', compact('orders', 'order', 'order_number'));
    }

    public function orderCancel($order_id) {
        $order = Order::where('order_number', $order_id)->first();
        if ($order->status == 0) {
            $order->status = 3;
            $order->save();
        }
        return back();
    }
}
