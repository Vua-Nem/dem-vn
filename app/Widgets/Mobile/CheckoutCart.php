<?php

namespace App\Widgets\Mobile;

use Arrilot\Widgets\AbstractWidget;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutCart extends AbstractWidget
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
    $cartCount = Cart::count();
    $carts = Cart::content();
    $vouchers = Cart::instance('voucher')->content();
    $totalAmount = 0;
    $totalDiscount = 0;

    foreach ($carts as $cart) {
      $totalAmount += ($cart->price * $cart->qty);
    }

    foreach ($vouchers as $voucher) {
      $totalDiscount += $voucher->price;
    }

    return view('widgets.mobile.checkout_cart', [
      'config' => $this->config,
      'totalAmount' => $totalAmount,
      'totalDiscount' => $totalDiscount,
      'carts' => $carts,
      'cartCount' => $cartCount,
      'vouchers' => $vouchers
    ])->render();
  }
}
