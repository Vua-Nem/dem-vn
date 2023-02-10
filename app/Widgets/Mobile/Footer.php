<?php

namespace App\Widgets\Mobile;

use App\Models\Category;
use App\Models\Product;
use Arrilot\Widgets\AbstractWidget;

class Footer extends AbstractWidget
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
    $categories = Category::with([
        'products' => function($q) {
            $q->with('images')
                ->where("products.status", Product::PRODUCT_STATUS_IS_ACTIVE)
                ->limit(8);
        }
    ])->get();

    return view('widgets.mobile.new_footer', [
      'config' => $this->config,
      'categories' => $categories
    ])->render();
  }
}
