<?php

namespace App\Http\Controllers;

use App\Service\ProductService;
use App\Models\Banner;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->getBanner();
        $productId = 10;
        $productService = new ProductService();
        $product = $productService->getProductById($productId);
        $product = $productService->addPromotionToProduct($product);
        $attrGroup = $productService->getProductVariantGroupByAttribute($productId);

        pd($attrGroup);

        return view('home')
            ->with("attrGroup", $attrGroup)
            ->with("product", $product)
            ->with("banners", $banners);
    }

    public function getBanner()
    {
        $time = time();
        // $arrayBanner = Cache::remember("cache_banner_homepage_v1", 1, function () {
            
        $data = Banner::where('type', 0)
            ->where('status', Banner::BANNER_IS_ACTIVE)
            ->where('time_start', '<=', $time)
            ->where('time_end','>', $time)
            ->orderBy('position', 'ASC')->get();

        $arrayBanner = [];
        foreach ($data as $value) {
            $arrayBanner[$value->slost][] = $value;
        }
        return $arrayBanner;
        
        // });
        // return $arrayBanner;
    }
}
