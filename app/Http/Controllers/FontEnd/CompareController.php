<?php

namespace App\Http\Controllers\FontEnd;

use App\Http\Controllers\AppBaseController;
use App\Models\Review;
use App\Models\Product;

class CompareController extends AppBaseController
{
    public function index($slug)
    {
        $productCurrent = Product::where("slug", $slug)->first();

        $products = Product::select('id','name','slug')->get()->keyBy("id")->toArray();

        if (empty($productCurrent) || !isset($products[$productCurrent->id]))
        return redirect()->route("home");

        $reviews = Review::where('status', Review::REVIEW_IS_ACTIVE)->with('getUser', 'reviewImage', 'getProduct')->inRandomOrder()->take(15)->get();

        return view('font_end.compare')
            ->with("currentProductId", $productCurrent->id)
            ->with("products", $products)
            ->with("reviews", $reviews);
    }
}
