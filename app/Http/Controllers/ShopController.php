<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator; // Import Paginator

class ShopController extends Controller
{
    public function index()
    {
        //
        $title = "Shop";
        $productQuery = Product::query();
        $productQuery->orderBy("id", "desc");
        $products = $productQuery->paginate(8);
        return view("dashboard.shop.index", compact('title', 'products'));
    }

   
}
