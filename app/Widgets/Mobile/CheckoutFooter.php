<?php

namespace App\Widgets\Mobile;

use Arrilot\Widgets\AbstractWidget;

class CheckoutFooter extends AbstractWidget
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
    return view('widgets.mobile.checkout_footer', [
      'config' => $this->config,
    ])->render();
  }
}
