<?php

Route::prefix('admin')->group(function () {
    Route::middleware(['auth', 'verifyAdminLevel'])->group(function () {

        Route::resource('products', App\Http\Controllers\Admin\ProductController::class);

        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);

        Route::resource('attributes', App\Http\Controllers\Admin\AttributeController::class);

        Route::resource('attributeValues', App\Http\Controllers\Admin\AttributeValueController::class);

        // Route::resource('tmpProducts', App\Http\Controllers\Admin\TmpProductController::class);

        // Route::resource('vendors', App\Http\Controllers\Admin\VendorController::class);

        Route::resource('brands', App\Http\Controllers\Admin\BrandController::class);

        Route::resource('productVariants', App\Http\Controllers\Admin\ProductVariantController::class);

        Route::resource('productImages', App\Http\Controllers\Admin\ProductImageController::class);

        Route::resource('menus', App\Http\Controllers\Admin\MenuController::class);

        Route::get('/ajax/attribute-value', [App\Http\Controllers\Admin\AjaxController::class, 'getAttributeValue'])
            ->name('ajaxGetAttributeValue');

        // Route::get('/ajax/getDistrict', [App\Http\Controllers\Admin\AjaxController::class, 'getDistrict'])
        //     ->name('ajax.getDistrict');

        Route::resource('productAttributeValues', App\Http\Controllers\Admin\ProductAttributeValueController::class);

        // Route::resource('promotions', App\Http\Controllers\Admin\PromotionController::class);

        // Route::resource('promotionObjects', App\Http\Controllers\Admin\PromotionObjectController::class);

        // Route::resource('topProducts', App\Http\Controllers\Admin\TopProductController::class);

        // Route::resource('provinces', App\Http\Controllers\Admin\ProvinceController::class);

        // Route::resource('districts', App\Http\Controllers\Admin\DistrictController::class);

        Route::post('orders/addCart', [App\Http\Controllers\Admin\OrdersController::class, 'addCart'])
            ->name("addCart");

        Route::get('orders/removerCartItem', [App\Http\Controllers\Admin\OrdersController::class, 'removerCartItem'])
            ->name("removerCartItem");

        Route::post('orders/saveCart', [App\Http\Controllers\Admin\OrdersController::class, 'saveCart'])
            ->name("saveCart");

        Route::post('orders/postUpdate/{id}', [App\Http\Controllers\Admin\OrdersController::class, 'postUpdate'])
            ->name("admin.order.postUpdate");

        Route::get('orders/loadCart/{orderId}', [App\Http\Controllers\Admin\OrdersController::class, 'loadCart'])
            ->name("admin.order.loadCart");

        Route::resource('orders', App\Http\Controllers\Admin\OrdersController::class);

        Route::resource('orderLogs', App\Http\Controllers\Admin\OrderLogController::class);

        Route::resource('vNPayCallLogs', App\Http\Controllers\Admin\VNPayCallLogsController::class);

		Route::resource('payooCallLogs', App\Http\Controllers\Admin\PayooCallLogController::class);

//		Route::resource('partialPaymentFees', App\Http\Controllers\Admin\PartialPaymentFeeController::class);

		Route::resource('payooIpnErrorLogs', App\Http\Controllers\Admin\PayooIpnErrorLogController::class);

        Route::resource('tinyKeys', App\Http\Controllers\Admin\TinyKeyController::class);

        Route::resource('pageNews', App\Http\Controllers\Admin\PageNewsController::class);

        Route::resource('vouchers', App\Http\Controllers\Admin\VoucherController::class);

        Route::resource('banners', App\Http\Controllers\Admin\BannerController::class);

		Route::post('/updateStatus',  [App\Http\Controllers\Admin\BannerController::class, 'postUpdateStatus'])->name('update_status');

        Route::resource('orderVouchers', App\Http\Controllers\OrderVoucherController::class);

        // Route::resource('landingContactForms', App\Http\Controllers\Admin\LandingContactFormController::class);

        Route::resource('contacts', App\Http\Controllers\Admin\ContactController::class);

        Route::resource('reviews', App\Http\Controllers\Admin\ReviewController::class);

		Route::resource('countDowns', App\Http\Controllers\Admin\CountDownController::class);

		Route::get('count-down/product', [App\Http\Controllers\Admin\CountDownController::class, 'countDownProduct'])
			->name("count_down_product");

		Route::resource('notifySales', App\Http\Controllers\Admin\NotifySaleController::class);

		Route::get('add/notify-sale/product', [App\Http\Controllers\Admin\NotifySaleController::class, 'addNotifySaleProduct'])
			->name("notify_sale_product");

		// Route::resource('productBundles', App\Http\Controllers\Admin\ProductBundlesController::class);

		// Route::resource('wishLists', App\Http\Controllers\Admin\WishListController::class);

		// Route::resource('retailerAddresses', App\Http\Controllers\Admin\RetailerAddressController::class);

		Route::resource('seoContents', App\Http\Controllers\Admin\SeoContentController::class);
        
        Route::resource('productShortDescriptions', App\Http\Controllers\Admin\ProductShortDescriptionController::class);
    });
});