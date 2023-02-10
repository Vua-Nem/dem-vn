<?php

Route::get('/', [App\Http\Controllers\Mobile\HomeController::class, 'index'])->name('home');

Route::get('/cart', [App\Http\Controllers\Mobile\CartController::class, 'showCart'])
    ->name('cart.showCart');

Route::post('/cart', [App\Http\Controllers\Mobile\CartController::class, 'addCart'])
    ->name('cart.addcart');

Route::get('/cart/{itemId}/delete', [App\Http\Controllers\Mobile\CartController::class, 'cartRemoveItem'])
    ->name('cart.cartRemoveItem');

Route::get('/cart/destroy', [App\Http\Controllers\Mobile\CartController::class, 'cartDestroy'])
    ->name('cart.cartDestroy');

Route::get('/order/customer', [App\Http\Controllers\Mobile\OrderController::class, 'checkOut'])
    ->name('order.checkOut');

Route::post('/order/customer', [App\Http\Controllers\Mobile\OrderController::class, 'saveCustomer'])
    ->name('order.customer');

Route::get('/order/payment', [App\Http\Controllers\Mobile\OrderController::class, 'payment'])
    ->name('order.payment');

Route::post('/order/saveOrder', [App\Http\Controllers\Mobile\OrderController::class, 'saveOrder'])
    ->name('order.saveOrder');

Route::get('/order/success', [App\Http\Controllers\Mobile\OrderController::class, 'success'])
    ->name('order.success');

Route::get('/order/cancel', [App\Http\Controllers\Mobile\OrderController::class, 'cancel'])
	->name('order.cancel');

Route::get('/vnpay/ipn', [App\Http\Controllers\Mobile\OrderController::class, 'vnPayOrderUpdate'])
    ->name('order.vnPayOrderUpdate');


Route::get('payoo/create-url-payment/{orderId}', [App\Http\Controllers\Mobile\Payoo\PayooController::class, 'createUrlPayment'])
	->name('payoo.createUrlPayment');

Route::get('payoo/order/comfirm', [App\Http\Controllers\Mobile\Payoo\PayooController::class, 'payooTransactionConfirm'])
	->name('payoo.shopBack');

Route::post('payoo/ipn', [App\Http\Controllers\Mobile\Payoo\PayooController::class, 'pIpn'])
	->name('payoo.ipn');

Route::get('/payoo/price-rules-pay', [App\Http\Controllers\Mobile\Payoo\AjaxController::class, 'getPriceRulesPay'])
	->name('payoo.price.rules.pay');

// Route::get('/products/dem_foam_gap_3_goodnight_eva.html', [App\Http\Controllers\Mobile\HomeController::class, 'productDetail1'])
//     ->name('product.detail1');

// Route::get('/products/dem_foam_goodnight_galaxy.html', [App\Http\Controllers\Mobile\HomeController::class, 'productDetail2'])
//     ->name('product.detail2');

// Route::get('/products/dem_lo_xo_goodnight_4stars.html', [App\Http\Controllers\Mobile\HomeController::class, 'productDetail3'])
//     ->name('product.detail3');

// Route::get('/products/dem_foam_goodnight_massage_nhat_ban.html', [App\Http\Controllers\Mobile\HomeController::class, 'productDetail4'])
// ->name('product.detail4');

// Route::get('/products/dem_foam_than_hoat_tinh_zinus_charcoal_foam.html', [App\Http\Controllers\Mobile\HomeController::class, 'productDetail5'])
// 	->name('product.detail5');

Route::get('/category/{slug}.html', [App\Http\Controllers\Mobile\HomeController::class, 'categoryDetail'])
    ->name('category.detail');

Route::get('/products/{slug}.html', [App\Http\Controllers\Mobile\HomeController::class, 'productDetail'])
    ->name('product.detail');


Route::get('/so-sanh/{id}', [App\Http\Controllers\Mobile\CompareController::class, 'index'])
    ->name('sosanh');

Route::get('/chinh-sach', [App\Http\Controllers\Mobile\HomeController::class, 'chinhsach'])
    ->name('chinhsach');

Route::get('/landing/good-night', [App\Http\Controllers\Mobile\LandingController::class, 'landingGoodNight'])
    ->name('landing.goodnight');

Route::get('/stores', [App\Http\Controllers\Mobile\StoreController::class, 'index'])
	->name('stores');

Route::get('/ajax/getStore', [App\Http\Controllers\Admin\AjaxController::class, 'getStore'])
	->name('ajax.getStore');

Route::get('/ajax/getStoreDistrict', [App\Http\Controllers\FontEnd\AjaxController::class, 'getStoreDistrict'])
	->name('ajax.getStoreDistrict');

Route::post('/contact', [App\Http\Controllers\Mobile\HomeController::class, 'contact'])->name('contact');

Route::get('/search', [App\Http\Controllers\Mobile\HomeController::class, 'search'])->name('search');