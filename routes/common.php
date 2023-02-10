<?php

Auth::routes();

Route::get('image/products/{id}/{size}/{fileName}', function ($id, $size, $fileName) {
    $extension = last(explode('.', $fileName));
    $storagePath = storage_path('app/public/products/' . $id . "/" . $size . "/" . $fileName);
    if ($fileName === "default.jpg")
        return response()->file(public_path("web/image/product_default.jpg"), array('Content-Type' => 'image/' . $extension));

    return response()->file($storagePath, array('Content-Type' => 'image/' . $extension));
})->name("productImageShow");

Route::get('image/{entity}/{id}/{size}/{fileName}', function ($entity, $id, $size, $fileName) {
    $extension = last(explode('.', $fileName));
    $storagePath = storage_path('app/public/' . $entity . '/' . $id . "/" . $size . "/" . $fileName);
    return response()->file($storagePath, array('Content-Type' => 'image/' . $extension));
})->name("showImage");

Route::get('image/{folder}/{id}/{fileName}', function ($folder, $id, $fileName) {
    $extension = last(explode('.', $fileName));
    $storagePath = storage_path('app/public/' . $folder . '/' . $id . '/' . $fileName);
    return response()->file($storagePath, array('Content-Type' => 'image/' . $extension));
})->name("showImage2");

Route::get('image/{folder}/{fileName}', function ($foder, $fileName) {
    $extension = last(explode('.', $fileName));
    $storagePath = storage_path('app/public/' . $foder . '/' . $fileName);
    return response()->file($storagePath, array('Content-Type' => 'image/' . $extension));
})->name("showImageFolder");

Route::get('image/banners/{fileName}', function ($fileName) {
    $extension = last(explode('.', $fileName));
    $storagePath = storage_path('app/public/banners/' . $fileName);
    return response()->file($storagePath, array('Content-Type' => 'image/' . $extension));
})->name("showImageBanner");

Route::get('image/reviews/{fileName}', function ($fileName) {
    $extension = last(explode('.', $fileName));
    $storagePath = storage_path('app/public/reviews/' . $fileName);
    return response()->file($storagePath, array('Content-Type' => 'image/' . $extension));
})->name("showImageReview");

Route::get('/ajax/getDistrict', [App\Http\Controllers\FontEnd\AjaxController::class, 'getDistrict'])
    ->name('ajax.getDistrict');

Route::post('/ajax/voucher/add', [App\Http\Controllers\Common\AjaxController::class, 'addVoucher'])
    ->name("cart.addVoucher");

Route::get('/ajax/voucher/delete', [App\Http\Controllers\Common\AjaxController::class, 'removerVoucher'])
    ->name("cart.removerVoucher");

Route::get('/ajax/cart/update', [App\Http\Controllers\Common\AjaxController::class, 'updateCartQty'])
    ->name("cart.updateCartQty");

Route::get('/wp/menu-header', [App\Http\Controllers\FontEnd\WPHeaderController::class, 'index']);

Route::get('/landing/dang-ky-nhan-voucher-1-trieu', [App\Http\Controllers\Common\LandingController::class, 'index'])
    ->name('landing.index');

Route::post('/landing/dang-ky-nhan-voucher-1-trieu', [App\Http\Controllers\Common\LandingController::class, 'postIndex'])
    ->name('landing.postIndex');

Route::get('/landing/nhan-qua-8-3-tu-dem-vn', [App\Http\Controllers\Common\LandingController::class, 'nhanQua'])
    ->name('landing.nhanQua');

Route::post('/landing/nhan-qua-8-3-tu-dem-vn', [App\Http\Controllers\Common\LandingController::class, 'postIndex'])
    ->name('landing.postIndex');

Route::get('/landing/good-night', [App\Http\Controllers\Common\LandingController::class, 'landingGoodNight'])
	->name('landing.goodnight');
