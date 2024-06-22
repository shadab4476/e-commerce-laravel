<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Nette\Utils\Html;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    //
    public function index()
    {
        $title = "All Orders";
        $orders = Order::whereUser_id(auth()->user()->id);
        if (request()->ajax()) {
            $dataTable = DataTables::of($orders)->addColumn("product_image", function ($row) {
                $imgSrc = asset("assets/images/" . $row->product->image);
                $link = route('order.detail', $row->id);
                $img = '<div data-active="' . $link . '" class="detail_order  flex justify-center cursor-pointer"><img class="w-[150px] h-[150px] object-cover object-center block" src="' . $imgSrc . '" alt="product image"></div>';
                return Html::fromHtml($img);
            })->addColumn("product_name", function ($row) {
                return Html::fromHtml($row->product->name);
            })->addColumn("product_price", function ($row) {
                return Html::fromHtml("₹" . $row->product->price);
            })->addColumn("payment_status", function ($row) {
                if ($row->payment_status == 1) {
                    return Html::fromHtml("Delivered");
                }
                return Html::fromHtml("Failed");
            })->addColumn("data_time", function ($row) {
                if ($row->created_at) {
                    return Html::fromHtml($row->created_at);
                }
                return Html::fromHtml("Failed");
            });
            return $dataTable->make(true);
        }
        return view("dashboard.order.index", compact('title', "orders"));
    }

    public function orderQty()
    {
        $order_qty = 0;
        $order = Order::whereUser_id(auth()->user()->id)->get(['id']);
        if (count($order) > 0) {
            $order_qty = count($order);
        } else {
            $order_qty = 0;
        }
        return response()->json(["status" => $order_qty]);
    }

    public function orderDetail($id)
    {
        try {
            $order =    Order::with("product")->with("user")->with("address")->find($id);
            $product_show = route("product.show", $order->product->id);
            return response()->json(["status" => $order, "product_show" => $product_show]);
        } catch (\Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }
}
