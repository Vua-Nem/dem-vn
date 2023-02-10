<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\AppBaseController;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AjaxController extends AppBaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addVoucher(Request $request)
    {
        if (!isset($request->voucher))
            return $this->sendError("Xin vui lòng nhập mã giảm giá !", 200);

        if (Cart::instance('voucher')->count() > 0)
            return $this->sendError("Bạn không thể áp dụng 2 Voucher cho một đơn hàng !", 200);

        $voucher = Voucher::where("code", Str::slug($request->voucher))
            ->where("start_date", "<=", time())
            ->where("end_date", ">=", time())
            ->first();

        if (empty($voucher))
            return $this->sendError("Mã giảm giá của bạn không tồn tại !", 200);

        if ($voucher->status != Voucher::VOUCHER_STATUS_IS_HIDDEN && $voucher->status != Voucher::VOUCHER_STATUS_IS_ACTIVE)
            return $this->sendError("Mã giảm giá của bạn không hoạt động !", 200);

        $totalAmount = $this->getTotalAmountCart();
        if ($totalAmount < $voucher->min_order_amount)
            return $this->sendError("Giá trị đơn hàng của bạn không đủ điều kiện áp dụng mã giảm giá này !", 200);

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

        $voucher['total_amount'] = $this->getTotalAmountCart() - $voucherAmount;
        return $this->sendSuccess($voucher->toArray());
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
     * @return float|int
     */
    public function getTotalVoucherAmount()
    {
        $totalAmount = 0;
        foreach (Cart::instance('voucher')->content() as $item) {
            $totalAmount += $item->price;
        }

        return $totalAmount;
    }

    /**
     * @return mixed
     */
    public function removerVoucher()
    {
        Cart::instance('voucher')->destroy();
        $cartAmount = $this->getTotalAmountCart();
        return $this->sendSuccess(["amount" => $cartAmount]);
    }

    public function updateCartQty(Request $request)
    {
        $request = $request->all();
        $validator = Validator::make($request, [
            'qty' => 'integer',
        ]);
        if ($validator->fails()) return [];
        try {
            Cart::instance('default')->update($request["rowId"], $request["qty"]);
            $cart = Cart::get($request["rowId"]);
            list($productId) = explode("_", $cart->id);
            foreach (Cart::instance('default')->content() as $item) { //xóa sản phẩm bán kèm
                if ($item->options->product_attach_id == $productId)
                    Cart::instance('default')->update($item->rowId, $request["qty"]);
            }

            $subTotalAmount = $this->getTotalAmountCart();
            $voucherAmount = $this->getTotalVoucherAmount();
            return $this->sendSuccess(["subtotal" => $subTotalAmount,
                "grandTotal" => $subTotalAmount - $voucherAmount,]);
        } catch (\Exception $exception) {
            return [];
        }
    }
}
