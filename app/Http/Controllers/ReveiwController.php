<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReveiwController extends Controller
{

    public function review(Request $request)
    {
        $request->validate([
            "message" => "required",
            "user_id" => "required|exists:users,id",
            "product_id" => "required|exists:products,id",
            "review" => "required",
        ]);

        $review_data = Review::get(["user_id", "product_id"]);
        foreach ($review_data as $review) {
            if ($request->input('user_id') == $review->user_id && $request->input('product_id') == $review->product_id) {
                return redirect()->back()->with(["error" => "This User is already exists.."]);
            }
        }
        Review::create([
            "message" => $request->input("message"),
            "review" => $request->input("review"),
            "user_id" => $request->input("user_id"),
            "product_id" => $request->input("product_id"),
        ]);
        return redirect()->back()->with(["status" => "Review Submited.."]);
    }
}
