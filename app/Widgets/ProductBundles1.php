<?php

namespace App\Widgets;

use App\Models\ProductVariant;
use Arrilot\Widgets\AbstractWidget;

class ProductBundles extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
		$productBundles = \App\Models\ProductBundles::where('product_id', $this->config["entity_product_id"])
            ->get()
            ->keyBy("product_attach_id")
            ->toArray();

        $data = ProductVariant::with(["product", "product.images"])->whereIn("sku", array_keys($productBundles))->get();
        return view('widgets.product_bundles', [
            'data' => $data,
            'productBundles' => $productBundles,
        ]);
    }
}
