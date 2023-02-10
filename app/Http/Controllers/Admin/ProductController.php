<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDescription;
use App\Models\ProductImage;
use App\Models\ProductShortDescription;
use App\Repositories\ProductRepository;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Str;
use Response;
use App\Models\SeoContent;
use App\Repositories\ProductShortDescriptionRepository;
use Illuminate\Support\Facades\DB;

class ProductController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo, ProductShortDescriptionRepository $productShortDescriptionRepository)
    {
        $this->productRepository = $productRepo;
        $this->productShortDescriptionRepository = $productShortDescriptionRepository;
    }

    /**
     * Display a listing of the Product.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $products = Product::with(["brand", "variants", "category", "shortDescriptions"])->paginate(15);

        return view('admin.products.index')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.create')->with(['brands' => $brands, 'categories' => $categories]);
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     *
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->all();

        $input = array_merge(["slug" => Str::slug($request->name, "_")], $input);

        DB::beginTransaction();
        try {
            $product = $this->productRepository->create($input);
    
            if (isset($input["default_img"]) && !empty($input["default_img"])) {
                foreach ($input["default_img"] as $image) {
                    $this->createProductImage($product->id, $image);
                }
            }
            if (!empty($input['description'])) {
                $productDescription = new ProductDescription();
                $productDescription->product_id = $product->id;
                $productDescription->description = $input["description"];
                $productDescription->save();
            }

            if (!empty($input['shortDescriptions'])) {
                foreach ($input['shortDescriptions'] as $shortDescription) {
                    if (empty($shortDescription['name'])) {
                        continue;
                    }

                    $shortDescription['product_id'] = $product->id;
                    $this->productShortDescriptionRepository->create($shortDescription);
                }
            }
    
            DB::commit();
            Flash::success('Product saved successfully.');
        }
        catch (\Exception $exception) {
            DB::rollBack();
            Flash::error('Product saved fail.');
        }
        return redirect(route('products.index'));
    }

    /**
     * Display the specified Product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('admin.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::with(["variants", "images", "description", "shortDescriptions"])->find($id);
        $brands = Brand::all();
        $categories = Category::all();
        $seoContent = SeoContent::where("entity_type", SeoContent::SEO_PRODUCT)
        ->where("entity_id", $product->id)
        ->first();

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('admin.products.edit')
            ->with('seoContent', $seoContent)
            ->with('brands', $brands)
            ->with('categories', $categories)
            ->with('product', $product);
    }

    /**
     * Update the specified Product in storage.
     *
     * @param int $id
     * @param UpdateProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->find($id);
        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }

        $data = $request->all();

        DB::beginTransaction();
        try {
            if (isset($data["default_img"]) && !empty($data["default_img"])) {
                foreach ($data["default_img"] as $image) {
                    $this->createProductImage($id, $image);
                }
            }

            $productDescription = ProductDescription::where("product_id", $id)->first();
            if (empty($productDescription)) {
                $productDescription = new ProductDescription();
                $productDescription->product_id = $id;
            }

            $productDescription->description = $data["description"];
            $productDescription->save();

            if (!empty($data['shortDescriptions'])) {
                ProductShortDescription::query()->where('product_id', $id)->delete();
                foreach ($data['shortDescriptions'] as $shortDescription) {
                    if (empty($shortDescription['name'])) {
                        continue;
                    }

                    $shortDescription['product_id'] = $product->id;
                    $this->productShortDescriptionRepository->create($shortDescription);
                }
            }
            $data["slug"] = Str::slug($request->name, "_");
            if (empty($data["default_img"]))
                unset($data["default_img"]);

            $this->productRepository->update($data, $id);
            DB::commit();
            Flash::success('Product updated successfully.');
        }
        catch (\Exception $exception) {
            DB::rollBack();
            Flash::error('Product updated fail.');
        }
        return redirect(route('products.index'));
    }

    /**
     * @param $id
     * @param $image
     * @return ProductImage|bool
     */
    public function createProductImage($id, $image)
    {
        $fileUpload = new FileUploadService();
        $fileUploadResult = $fileUpload->upLoadImages($image, "public/products/" . $id, [
            "size" => [
                "105" => [
                    "width" => 105,
                    "height" => 69
                ],
                "609" => [
                    "width" => 609,
                    "height" => 380
                ],
                "340" => [
                    "width" => 340,
                    "height" => 340
                ]
            ]
        ]);

        if ($fileUploadResult["status"]) {
            $productImage = new ProductImage();
            $productImage->product_id = $id;
            $productImage->name = last(explode("/", $fileUploadResult["path"]));
            $productImage->path = $fileUploadResult["path"];
            $productImage->save();
            return true;
        }

        return false;
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('products.index'));
    }


}
