<?php

namespace App\Http\Controllers\Mobile;


use App\Http\Controllers\Controller;
use App\Models\Page_News;
use App\Models\Product;
use App\Models\Review;
use App\Services\ProductService;
use Illuminate\Support\Facades\Cache;
use App\Models\Banner;
use App\Models\Category;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use App\Models\SeoContent;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Services\SeoContentService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEOTools::opengraph()->addProperty('type', 'WebSite');
        SEOTools::opengraph()->setUrl(route("home"));
        SEOTools::opengraph()->setSiteName("dem.vn");
        SEOTools::setCanonical(route("home"));

        $seoContent = SeoContentService::getSeoContent(SeoContent::SEO_HOME_PAGE);
        if (!empty($seoContent->meta_title)) {
            SEOMeta::setTitle($seoContent->meta_title);
            SEOTools::opengraph()->setTitle($seoContent->meta_title);
            SEOMeta::addMeta('name', $seoContent->meta_title, 'itemprop');
        }
        if (!empty($seoContent->meta_des)) {
            SEOMeta::setDescription($seoContent->meta_des);
            SEOTools::opengraph()->setDescription($seoContent->meta_des);
            SEOMeta::addMeta('description', $seoContent->meta_des, 'itemprop');
        }

        if (!empty($seoContent->meta_keyword)) {
            SEOMeta::addKeyword($seoContent->meta_keyword);
        }

        JsonLdMulti::addValue("itemListElement", [[
            "@type" => "ListItem",
            "item" => ["@id" => route("home"), "name" => "Trang chủ"],
            "position" => 0
        ]]);
        
        
        $time = time();
        $banners = Banner::where('type', Banner::BANNER_HOME)
            ->where('is_mobile', Banner::BANNER_IS_MOBILE_WEB)
            ->where('status', Banner::BANNER_IS_ACTIVE)
            ->where('time_start', '<=', $time)
            ->where('time_end', '>', $time)
            ->get();

        $categories = Category::with([
            'products' => function ($q) {
                $q->with(['images', 'reviews', 'shortDescriptions'])
                    ->where("products.status", Product::PRODUCT_STATUS_IS_ACTIVE)
                    ->limit(8);
            }
        ])->get();

        return view('mobile.home.new_index')
            ->with("banners", $banners)
            ->with("categories", $categories);
    }

    public function categoryDetail($slug)
    {
        $category = Category::where("slug", $slug)->first();

        $products = Product::where('category_id', $category->id)
            ->with('images')
            ->where("products.status", Product::PRODUCT_STATUS_IS_ACTIVE)
            ->paginate(2);

        $time = time();
        $banners = Banner::where('type', Banner::BANNER_CATEGORY_DETAIL)
        ->where('is_mobile', Banner::BANNER_IS_MOBILE_WEB)
        ->where('status', Banner::BANNER_IS_ACTIVE)
        ->where('time_start', '<=', $time)
        ->where('time_end', '>', $time)
        ->get();
        if (empty($category)) {
            return redirect()->route("home");
        }

        return view('mobile.category.detail')
            ->with("products", $products)
            ->with("banners", $banners)
            ->with("category", $category);
    }

    public function productDetail1()
    {
        $product = Product::with(["images", "description"])->where("slug", "dem_foam_gap_3_goodnight_eva")->first();
        $reviews = Review::where('status', Review::REVIEW_IS_ACTIVE)
        ->where('entity_id', $product->id)
        ->with('getUser', 'reviewImage', 'getProduct')->take(5)->get();
        $productService = new ProductService();
        $attrGroup = $productService->getProductVariantGroupByAttribute($product->id);
        ksort($attrGroup["attributeGroup"]);
        $seoContent = $productService->getProductSeoContent($product->id);
        $this->productMeta($product, $seoContent, $reviews);
        return view('mobile.product.detail')
            ->with("attributeName", $attrGroup["attributeName"] ?? [])
            ->with("attributeGroup", $attrGroup["attributeGroup"] ?? [])
            ->with("product", $product)
            ->with("reviews", $reviews);
    }

    public function productDetail2()
    {
        $product = Product::with(["images", "description"])->where("slug", "dem_foam_goodnight_galaxy")->first();
        $reviews = Review::where('status', Review::REVIEW_IS_ACTIVE)
        ->where('entity_id', $product->id)
        ->with('getUser', 'reviewImage', 'getProduct')->take(5)->get();
        $productService = new ProductService();
        $attrGroup = $productService->getProductVariantGroupByAttribute($product->id);
        ksort($attrGroup["attributeGroup"]);
        $seoContent = $productService->getProductSeoContent($product->id);
        $this->productMeta($product, $seoContent, $reviews);
        return view('mobile.product.detail3')
            ->with("attributeName", $attrGroup["attributeName"] ?? [])
            ->with("attributeGroup", $attrGroup["attributeGroup"] ?? [])
            ->with("product", $product)
            ->with("reviews", $reviews);
    }

    public function productDetail3()
    {
        $product = Product::with(["images", "description"])->where("slug", "dem_lo_xo_goodnight_4stars")->first();
        if (empty($product))
            return redirect()->route("home");
        
        $reviews = Review::where('status', Review::REVIEW_IS_ACTIVE)
            ->where('entity_id', $product->id)
            ->with('getUser', 'reviewImage', 'getProduct')->take(5)->get();
        $productService = new ProductService();
        $attrGroup = $productService->getProductVariantGroupByAttribute($product->id);
        ksort($attrGroup["attributeGroup"]);
        $seoContent = $productService->getProductSeoContent($product->id);
        $this->productMeta($product, $seoContent, $reviews);
        return view('mobile.product.detail2')
            ->with("attributeName", $attrGroup["attributeName"] ?? [])
            ->with("attributeGroup", $attrGroup["attributeGroup"] ?? [])
            ->with("product", $product)
            ->with("reviews", $reviews);
    }

    public function productDetail4()
    {
        $product = Product::with(["images", "description"])->where("slug", "dem_foam_goodnight_massage_nhat_ban")->first();
        if (empty($product))
            return redirect()->route("home");
        
        $reviews = Review::where('status', Review::REVIEW_IS_ACTIVE)
            ->where('entity_id', $product->id)
            ->with('getUser', 'reviewImage', 'getProduct')->take(5)->get();
        $productService = new ProductService();
        $attrGroup = $productService->getProductVariantGroupByAttribute($product->id);
        $seoContent = $productService->getProductSeoContent($product->id);
        $this->productMeta($product, $seoContent, $reviews);
        ksort($attrGroup["attributeGroup"]);
        return view('mobile.product.detail4')
            ->with("attributeName", $attrGroup["attributeName"] ?? [])
            ->with("attributeGroup", $attrGroup["attributeGroup"] ?? [])
            ->with("product", $product)
            ->with("reviews", $reviews);
    }

	public function productDetail5()
	{
		$product = Product::with(["images", "description"])->where("slug", "dem_foam_than_hoat_tinh_zinus_charcoal_foam")->first();
		if (empty($product))
			return redirect()->route("home");

		$reviews = Review::where('status', Review::REVIEW_IS_ACTIVE)
			->where('entity_id', $product->id)
			->with('getUser', 'reviewImage', 'getProduct')->take(5)->get();
		$productService = new ProductService();
		$attrGroup = $productService->getProductVariantGroupByAttribute($product->id);
		ksort($attrGroup["attributeGroup"]);
        $seoContent = $productService->getProductSeoContent($product->id);
        $this->productMeta($product, $seoContent, $reviews);
		return view('mobile.product.detail5')
			->with("attributeName", $attrGroup["attributeName"] ?? [])
			->with("attributeGroup", $attrGroup["attributeGroup"] ?? [])
			->with("product", $product)
			->with("reviews", $reviews);
	}

    /**
     * @param $slug
     * @return mixed
     */
    public function productDetail($slug)
    {
        $product = Product::with(["images", "description", "category", "reviews", "shortDescriptions"])->where("slug", $slug)->first();
        if (empty($product)) {
            return redirect()->route("home");
        }

        $reviews = Review::where('status', Review::REVIEW_IS_ACTIVE)
            ->where('entity_id', $product->id)
            ->with('getUser', 'reviewImage', 'getProduct')->limit(4)->get();

        $productService = new ProductService();
        $seoContent = $productService->getProductSeoContent($product->id);
        $attrGroup = $productService->getProductVariantGroupByAttribute($product->id);
        ksort($attrGroup["attributeGroup"]);
        $this->productMeta($product, $seoContent, $reviews);
        return view('mobile.product.newDetail')
            ->with("attributeName", $attrGroup["attributeName"] ?? [])
            ->with("attributeGroup", $attrGroup["attributeGroup"] ?? [])
            ->with("product", $product)
            ->with("reviews", $reviews);
    }

    public function contact(Request $request)
    {
        $request = $request->all();
        $messages = [
            'phone.required' => 'Vui lòng không bỏ trống',
        ];

        $validator = Validator::make($request, [
            'phone' => ['required', new CheckPhone()],
        ], $messages);

        $contact = [
            "phone" => $request["phone"],
            "full_name" => $request["full_name"] ?? ''
        ];
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        session(['contact' => $contact]);
        $contactRepository = App::make(ContactRepository::class);
        $contactRepository->create($request);
        return redirect()->route("home");
    }

    public function search(Request $request)
    {
        $keyword = $request->query('keyword');
        $products = Product::where('name', 'like', '%'.$keyword.'%')
            ->with('images')
            ->where("products.status", Product::PRODUCT_STATUS_IS_ACTIVE)
            ->get();
        return view('mobile.home.search', compact('products', 'keyword'));
    }

    public function chinhsach()
    {
        return view("mobile.home.chinhsach");
    }

    public function productMeta($product, $seoContent, $reviews)
    {
        $aryReviews = [];
        $rating = $totalRate = 0;

        foreach ($reviews as $review) {
            $rating = $rating + $review->rating;
            $aryReviews[] = ["@type" => "Review",
                "dateCreated" => $review->created_at,
                "datePublished" => $review->created_at,
                "headline" => "",
                "reviewBody" => $review->content,
                "reviewRating" => [
                    "@type" => "Rating",
                    "ratingValue" => $review->rating,
                    "bestRating" => 5
                ],
                "author" => [
                    "@type" => "Thing",
                    "name" => $review->user_id
                ],
                "image" => [],
                "video" => [],
                "comment" => []
            ];

            $totalRate++;
        }

        SEOTools::setCanonical(route("product.detail", ["slug" => $product->slug]));
        if (!empty($seoContent->meta_title)) {
            SEOMeta::setTitle($seoContent->meta_title);
            SEOTools::opengraph()->setTitle($seoContent->meta_title);
            SEOMeta::addMeta('name', $seoContent->meta_title, 'property');
        }
        if (!empty($seoContent->meta_des)) {
            SEOMeta::setDescription($seoContent->meta_des);
            SEOTools::opengraph()->setDescription($seoContent->meta_des);
            SEOMeta::addMeta('description', $seoContent->meta_des, 'property');
        }

        if (!empty($seoContent->meta_keyword)) {
            SEOMeta::addKeyword($seoContent->meta_keyword);
        }

        SEOMeta::addMeta('fb:app_id', '260870448026139', 'property');
        SEOMeta::addMeta('product:price:amount', $product->price, 'property');
        SEOMeta::addMeta('product:price:currency', 'VND', 'property');
        SEOMeta::addMeta('product:brand', $product->brand->name, 'property');
        SEOMeta::addMeta('product:availability', 'instock', 'property');
        SEOTools::opengraph()->addProperty('type', 'product');
        SEOTools::opengraph()->setUrl(route("product.detail", ["slug" => $product->slug]));
        SEOTools::opengraph()->addImage(route("productImageShow", [
            "id" => $product->id,
            "fileName" => $product->images->first() ? $product->images->first()->name : 'default.jpg',
            "size" => 609
        ]));

        JsonLdMulti::setType('WebPage');
        JsonLdMulti::addValue("speakable", [
            "@type" => "SpeakableSpecification",
            "cssSelector" => [".description"],
            "xpath" => ["/html/head/title"]
        ]);

        JsonLdMulti::newJsonLd();
        JsonLdMulti::setType('Product');
        JsonLdMulti::addValue("name", $product->name);
        JsonLdMulti::addValue("brand", ["@type" => "Brand", "name" => $product->brand->name]);
        JsonLdMulti::addValue("sku", $product->sku);
        JsonLdMulti::addValue("offers", [
            "@type" => "http://schema.org/Offer",
            "price" => $product->price,
            "priceCurrency" => "VND",
            "availability" => "http://schema.org/InStock",
            "url" => route("product.detail", ["slug" => $product->slug]),
            "itemCondition" => "https://schema.org/NewCondition",
            "seller" => ["name" => "Vua Nệm", "type" => "Organization"],
            "aggregateRating" => [
                "@type" => "AggregateRating",
                "ratingValue" => ($totalRate) ? ($rating / $totalRate) : 0,
                "reviewCount" => $totalRate
            ],
            "review" => $aryReviews,
            "additionalProperty" => [
                [
                    "@type" => "PropertyValue",
                    "name" => "Loại nệm",
                ], [
                    "@type" => "PropertyValue",
                    "name" => "Hàng",
                    "value" => "Chính Hãng"
                ]
            ]
        ]);

        JsonLdMulti::addValue("image", route("productImageShow", [
            "id" => $product->id,
            "fileName" => $product->images->first() ? $product->images->first()->name : 'default.jpg',
            "size" => 609
        ]));

        if (!empty($product->description->description))
            JsonLdMulti::addValue("description", $product->description->description);
    }
}
