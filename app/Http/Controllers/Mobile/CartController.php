<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\ProductBundles;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Voucher;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function showCart()
	{
		return view('mobile.cart.show_cart');
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function addCart(Request $request)
	{

		$data = $request->all();
		$validator = Validator::make($data, [
			'product_variant' => 'integer',
			'quantity' => 'integer',
		]);
		if ($validator->fails()) {
			return redirect()->back();
		}

		if (!isset($request->product_variant)) {
			return redirect()->route("cart.showCart")
				->withErrors("errors", "Xin lỗi, chúng tôi không tìm thấy sản phẩm của bạn!");
		}

		$productVariant = ProductVariant::with("product")->find($request->product_variant);
		if (empty($productVariant)) {
			return redirect()->route("cart.showCart")
				->withErrors("errors", "Xin lỗi, chúng tôi không tìm thấy sản phẩm của bạn!");
		}

		if (isset($data["product_variant_attach"])) {//them san pham ban kem vao gio hang
			$attachData = $this->addProductBundleToCart($productVariant->product_id, $data["product_variant_attach"]);
			if ($attachData["status"] == false)
				return redirect()->route("cart.showCart")->withErrors("errors", $attachData["message"]);
		}

		$productImages = ProductImage::where("product_id", $productVariant->product_id)->first();

		Cart::add([
			'id' => $productVariant->product_id . "_" . $productVariant->id,
			'name' => $productVariant->product->name,
			'qty' => $data["quantity"] ?? 1,
			'price' => $productVariant->price,
			'weight' => 0,
			'options' => [
				'product_attach_status' => false,
				'product_attach_id' => 0,
				'default_img' => route("productImageShow", [
					"id" => $productVariant->product_id,
					"size" => 340,
					"fileName" => empty($productImages) ? "default.jpg" : $productImages->name
				]),
				'width' => $productVariant->width,
				'length' => $productVariant->length,
				'thickness' => $productVariant->thickness,
				'compare_price' => $productVariant->compare_price,
				'inStock' => $productVariant->qty,
				'promotion_id' => 0,
				'promotion_discount' => 0,
			]
		]);

		return redirect()->back()->with('addToCart', "Don't Open this link");
	}

	/**
	 * @param $productId
	 * @param $attachId
	 * @return array|bool
	 */
	public function addProductBundleToCart($productId, $attachId)
	{
		$productVariant = ProductVariant::with("product")->find($attachId);
		if (empty($productVariant)) {
			return [
				"status" => false,
				"message" => "Xin lỗi, chúng tôi không tìm thấy sản phẩm mua kèm của bạn!"
			];
		}

		$productBundle = ProductBundles::where("product_id", $productId)
			->where("product_attach_id", $productVariant->sku)
			->first();

		if (empty($productBundle)) {
			return [
				"status" => false,
				"message" => "Xin lỗi, chúng tôi không tìm thấy sản phẩm mua kèm của bạn!"
			];
		}

		$productImages = ProductImage::where("product_id", $productVariant->product_id)->first();

		Cart::add([
			'id' => $productVariant->product_id . "_" . $productVariant->id,
			'name' => $productVariant->product->name,
			'qty' => 1,
			'price' => $productBundle->product_attach_price,
			'weight' => 0,
			'options' => [
				'product_attach_status' => true,
				'product_attach_id' => $productId,
				'default_img' => route("productImageShow", [
					"id" => $productVariant->product_id,
					"size" => 340,
					"fileName" => empty($productImages) ? "default.jpg" : $productImages->name
				]),
				'sku' => $productVariant->sku,
				'width' => $productVariant->width,
				'length' => $productVariant->length,
				'thickness' => $productVariant->thickness,
				'compare_price' => $productVariant->compare_price,
				'inStock' => $productVariant->qty,
				'promotion_id' => 0,
				'promotion_discount' => 0,
			]
		]);

		return [
			"status" => true,
			"message" => ""
		];
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function cartDestroy()
	{
		Cart::destroy();
		Cart::instance('voucher')->destroy();
		return redirect()->route("cart.showCart");
	}

	/**
	 * @param $itemId
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function cartRemoveItem($itemId)
	{

		try {
			Cart::remove($itemId);
			Cart::instance('voucher')->destroy();
		} catch (\Exception $exception) {

		}
		return redirect()->route("cart.showCart");
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function addVoucher(Request $request)
	{
		if (!isset($request->voucher))
			return redirect()->back()->withErrors("Xin vui lòng nhập mã giảm giá !");

		if (Cart::instance('voucher')->count() > 0)
			return redirect()->back()->withErrors("Bạn không thể áp dụng 2 Voucher cho một đơn hàng !");

		$voucher = Voucher::where("code", Str::slug($request->voucher))
			->where("status", Voucher::VOUCHER_STATUS_IS_ACTIVE)
			->where("status", Voucher::VOUCHER_STATUS_IS_HIDDEN)
			->where("start_date", "<=", time())
			->where("end_date", ">=", time())
			->first();
		pd($voucher);
		if (empty($voucher))
			return redirect()->back()->withErrors("Mã giảm giá của bạn không tồn tại !");

		$totalAmount = $this->getTotalAmountCart();
		if ($totalAmount < $voucher->min_order_amount)
			return redirect()->back()->withErrors("Giá trị đơn hàng của bạn không đủ điều kiện áp dụng mã giảm giá này !");

		$voucherAmount = $voucher->discount_value;
		if ($voucher->discount_type == Voucher::VOUCHER_DISCOUNT_TYPE_IS_PERCENTAGE)
			$voucherAmount = ($voucher->discount_value * $totalAmount) / 100;

		Cart::instance('voucher')->add(
			[
				'id' => $voucher->id,
				'name' => $voucher->code,
				'qty' => 1,
				'price' => $voucherAmount,
				'weight' => 0,
				'options' => [
					'min_order_amount' => $voucher->min_order_amount,
					'start_date' => $voucher->start_date,
					'end_date' => $voucher->end_date,
					'discount_type' => $voucher->discount_type,
					'discount_value' => $voucher->discount_value,
					'created_by' => $voucher->created_by,
				]
			]
		);

		return redirect()->back();
	}

	/**
	 * @return float|int
	 */
	public function getTotalAmountCart()
	{
		$totalAmount = 0;
		foreach (Cart::instance('default')->content() as $item) {
			$totalAmount += (($item->price - $item->options->promotion_discount) * $item->qty);
		}

		return $totalAmount;
	}

	/**
	 * @param $rowId
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function removerVoucher($rowId)
	{
		Cart::instance('voucher')->remove($rowId);
		return redirect()->back();
	}
}
