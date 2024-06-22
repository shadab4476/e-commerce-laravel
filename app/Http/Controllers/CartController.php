<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Nette\Utils\Html;
use Yajra\DataTables\Facades\DataTables;

class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = "Cart";
        if (request()->ajax()) {
            $role =  auth()->user()->roles->pluck('name')[0];
            $cart = Cart::with("product")->whereUser_id(auth()->user()->id)->get();
            $dataTable = DataTables::of($cart)->addColumn("image", function ($row) use ($role) {
                if ($role == "admin") {
                    $view = route('products.show', $row->product->id);
                } else {
                    $view = route('product.show', $row->product->id);
                }
                if ($row->product->image) {
                    $image =    asset('assets/images/' . $row->product->image);
                    $imageString = '<a href="' . $view . '" class="inline-block w-[75px] h-[75px]"><img class="w-[100%] block object-cover h-[100%]" src="' . $image . '" alt="Product Image"></a>';
                    return html::fromHtml($imageString);
                }
                return;
            })->addColumn("subtotal", function ($row) {
                if ($row->subtotal) {
                    return html::fromHtml('<span class="total_price">₹' . $row->subtotal . '</span>');
                }
                return html::fromHtml('<span class="total_price">₹' . $row->product->price . '</span>');
            })->addColumn("name", function ($row) use ($role) {
                $name_product = $row->product->name;
                if ($role == "admin") {
                    $view = route('products.show', $row->product->id);
                } else {
                    $view = route('product.show', $row->product->id);
                }
                $name = "<a href='$view' class='inline-block'><span class='text-yellow-500 font-bold'>$name_product </span></a>";
                return Html::fromHtml($name);
            })->addColumn("quantity", function ($row) {
                $quantity_sec =    '<div class="quantity_cart_table justify-center buttons_added flex">';
                $quantity_sec .=  '<button data-id="' . $row->id . '" type="button" class="minus minus_qty border-[1px] py-2  px-4 inline-block">-<button>';
                $quantity_sec .= ' <input type="number" class="w-[42px] quantity_cart_item text-center focus:outline-none h-[42px]"  value="' . $row->quantity . '" aria-label="Product quantity" size="4" min="1" max="" step="1" placeholder="" inputmode="numeric" autocomplete="off">';
                $quantity_sec .= '<button type="button"  data-id="' . $row->id . '" class="py-2 border-[1px] border-white px-4 inline-block plus_qty plus">+<button></div>';
                return Html::fromHtml($quantity_sec);
            })->addColumn("action", function ($row) {
                $delete = route('carts.destroy', $row->id);
                $HtmlAddAction = '<div class="action_table"><ul class="">';
                $HtmlAddAction .= '<li><a class="px-2 py-1 inline-block delete_cart_product" href="javascript:void(0)" data-product="' . $delete . '"><svg class="border-[1px] rounded-full ast-mobile-svg ast-close-svg" fill="currentColor" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5.293 6.707l5.293 5.293-5.293 5.293c-0.391 0.391-0.391 1.024 0 1.414s1.024 0.391 1.414 0l5.293-5.293 5.293 5.293c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414l-5.293-5.293 5.293-5.293c0.391-0.391 0.391-1.024 0-1.414s-1.024-0.391-1.414 0l-5.293 5.293-5.293-5.293c-0.391-0.391-1.024-0.391-1.414 0s-0.391 1.024 0 1.414z"></path></svg></a></li>';
                return Html::fromHtml($HtmlAddAction);
            });
            return  $dataTable->make(true);
        }
        $cart_id = Cart::whereUser_id(auth()->user()->id)->get(['id']);
        $items_price_total = Cart::whereUser_id(auth()->user()->id)->sum('subtotal');
        return view("dashboard.cart.index", compact('title', 'items_price_total','cart_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $cart = Cart::where("product_id", $request->p_id)->get();
        if ($cart->count() > 0) {
            $cart_old = Cart::where('product_id', '=', $request->p_id)->first();
            $cart_qnty = $cart_old->quantity;
            $cart_old->quantity = $request->q_id + $cart_qnty;
            $cart_old->subtotal += $request->subtotal * $request->q_id;
            $cart_old->update();
            return response()->json([
                "update" => "Product added to cart",
            ]);
        } else {
            try {
                Cart::create([
                    "quantity" => $request->q_id,
                    "product_id" => $request->p_id,
                    "subtotal" => $request->subtotal * $request->q_id,
                    "user_id" =>  auth()->user()->id,
                ]);
                $cart_qty = $this->cartQty()->original['status'];
                return response()->json([
                    "status" => "Product added to cart..",
                    "qty" => $cart_qty,
                ]);
            } catch (\Exception $exception) {
                return response()->json(["error" => $exception->getMessage()]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        try {
            $cart = Cart::find($request->cart_id);
            $cart->quantity = $request->qty;
            $total_price = $cart->product->price * $cart->quantity;
            $cart->subtotal = $total_price;
            $cart->update();
            $total_cart_item = Cart::whereUser_id(auth()->user()->id)->sum('subtotal');
            return response()->json([
                "status" => $request->qty,
                "subprice" => "₹$total_price",
                "totalPrice" => "₹$total_cart_item",
            ]);
        } catch (Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cart = Cart::find($id);
            if ($cart) {
                $cart->delete();
                $cart_qty = $this->cartQty()->original['status'];
                $cart_total = Cart::whereUser_id(auth()->user()->id)->sum('subtotal');
                return response()->json([
                    "status" => "Removed Cart Item..",
                    "cart_qty" => $cart_qty,
                    "total" => "₹$cart_total",
                ]);
            }
        } catch (Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }

    public function addToCart(Request $request)
    {
    }

    public function cartQty()
    {
        $cart_qty = 0;
        $cart = Cart::whereUser_id(auth()->user()->id)->get(['id']);
        if (count($cart) > 0) {
            $cart_qty = count($cart);
        } else {
            $cart_qty = 0;
        }
        return response()->json(["status" => $cart_qty]);
    }
}
