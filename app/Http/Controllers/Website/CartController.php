<?php

namespace App\Http\Controllers\Website;

use App\Models\Product;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function __construct() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function index()
    {
        $items = $_SESSION['cart'] ?? [];
        $sub_total = $this->getSubTotal();
        $vat = $this->getVAT();
        $grand_total = $this->getGrandTotal();
        $total_item = $this->cartTotalItem();
        return view('pages.cart', compact('items', 'sub_total', 'vat', 'grand_total'));
    }

    public function addNewItem(Request $request) {

        $request->validate([
            'product_id' => 'required|numeric',
            'product_image' => 'required',
            'product_name' => 'required',
            'product_quantity' => 'required',
            'product_price' => 'required',
        ]);

        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            $old = false;
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($key == $request->product_id) {
                    $total_quantity = $value['product_quantity'] + $request->product_quantity;
                    $_SESSION['cart'][$key]['product_quantity'] = $total_quantity;
                    $old = true;
                }
            }
            if ($old == false) {
                $_SESSION['cart'][$request->product_id] = [
                    'product_image' => $request->product_image,
                    'product_name' => $request->product_name,
                    'product_quantity' => $request->product_quantity,
                    'product_price' => $request->product_price
                ];
            }
        } else {
            $_SESSION['cart'][$request->product_id] = [
                'product_image' => $request->product_image,
                'product_name' => $request->product_name,
                'product_quantity' => $request->product_quantity,
                'product_price' => $request->product_price
            ];
        }
        
        return redirect()->route('cart');
    }

    public function updateQuantity($id, $quantity) {
        if (request()->ajax() && !empty($id) && !empty($quantity)) {
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($key == $id) {
                        $_SESSION['cart'][$key]['product_quantity'] = $quantity;
                        $unit_price = $_SESSION['cart'][$key]['product_price'];
                        $total_price = $unit_price * $_SESSION['cart'][$key]['product_quantity'];
                        return response()->json([
                            'success' => true,
                            'total_price' => number_format($total_price, 2),
                            'sub_total' => $this->getSubTotal(),
                            'vat' => $this->getVAT(),
                            'grand_total' => $this->getGrandTotal(),
                            'total_quantity' => $this->cartTotalQuantity()
                        ]);
                    }
                }
            }
        }
        return response()->json([
            'success' => false
        ]);
    }

    public function getSubTotal() {
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            $sub_total = 0;
            foreach ($_SESSION['cart'] as $key => $value) {
                $price = $_SESSION['cart'][$key]['product_price'] * 1;
                $quantity = $_SESSION['cart'][$key]['product_quantity'];
                $sub_total += $price * $quantity;
            }
            return $sub_total;
        }
        return 0;
    }

    public function getVAT() {
        return Settings::first()->vat;
    }

    public function getGrandTotal() {
        $withVat = ($this->getSubTotal() * $this->getVAT()) / 100;
        return $this->getSubTotal() + $withVat;
    }

    public function cartTotalItem() {
        return isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
    }

    public function cartTotalQuantity() {
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            $total_quantity = 0;
            foreach ($_SESSION['cart'] as $key => $value) {
                $total_quantity += $_SESSION['cart'][$key]['product_quantity'];
            }
            return $total_quantity;
        }
        return 0;
    }

    public function itemRemoveFromCart($id) {
        if (request()->ajax() && !empty($id)) {
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($key == $id) {
                        unset($_SESSION['cart'][$key]);
                        return response()->json([
                            'success' => true,
                            'sub_total' => $this->getSubTotal(),
                            'vat' => $this->getVAT(),
                            'grand_total' => $this->getGrandTotal(),
                            'total_quantity' => $this->cartTotalQuantity(),
                            'items' => $this->cartTotalItem()
                        ]);
                    }
                }
            }
        }
        return response()->json([
            'success' => false
        ]);
    }

}
