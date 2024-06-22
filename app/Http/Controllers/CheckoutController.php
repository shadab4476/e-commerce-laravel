<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function getCheckout($id, Request $request)
    {
        if ($request->data == "session") {
            session()->put("cnf_price", $request->qty);
            return response()->json([
                "status" => true
            ]);
        }
        $title = "Checkout";
        $product = Product::findOrFail($id);
        $address = Address::whereUser_id(auth()->user()->id)->first();
        $addresses = Address::whereUser_id(auth()->user()->id)->get();
        return view('dashboard.shop.checkout', compact('product', 'title', 'addresses', 'address'));
    }
    public function getCartCheckout()
    {
        $title = "Checkout";
        $items_price_total = Cart::whereUser_id(auth()->user()->id)->sum('subtotal');
        $carts = Cart::whereUser_id(auth()->user()->id)->get();
        $address = Address::whereUser_id(auth()->user()->id)->first();
        $addresses = Address::whereUser_id(auth()->user()->id)->get();
        return view('dashboard.shop.cart_checkout', compact('carts', 'title', 'addresses', 'items_price_total', 'address'));
    }
    public function addressChanged(Request $request)
    {
        try {
            $address = Address::findOrFail($request->id);
            return response()->json([
                "address" => $address,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "error" => $exception->getMessage(),
            ]);
        }
    }
    public function orderConfirmCart(Request $request)
    {

        try {
            $carts = Cart::whereUser_id(auth()->user()->id)->get();
            foreach ($carts as $cart) {
                $order = Order::create([
                    "user_id" => auth()->user()->id,
                    "address_id" => $request->address_id,
                    "product_id" => $cart->product->id,
                    "payment_mode" => $request->mode,
                    "payment_status" => true,
                ]);
            }
            foreach ($carts as $cart) {
                $cart->delete();
            }
            session()->put('user_order_id', $order->id);
            return response()->json([
                "orderId" => $order->id,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "error" => $exception->getMessage(),
            ]);
        }
    }
    public function orderConfirm(Request $request)
    {
        try {
            $order = Order::create([
                "user_id" => auth()->user()->id,
                "address_id" => $request->address_id,
                "product_id" => $request->product_id,
                "payment_mode" => $request->mode,
                "payment_status" => true,
            ]);
            session()->put('user_order_id', $order->id);
            return response()->json([
                "orderId" => $order->id,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "error" => $exception->getMessage(),
            ]);
        }
    }


    public function thankyou($id = null)
    {
        $title = "Thankyou";
        if ($id) {
            $order = Order::find($id);
        } else {
            $order = Order::find(session('user_order_id'));
        }
        return view("dashboard.shop.thankyou", compact('title', 'order'));
    }
}
