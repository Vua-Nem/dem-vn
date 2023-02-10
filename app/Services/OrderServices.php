<?php

namespace App\Services;

use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\OrderVoucher;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 12/21/2020
 * Time: 5:50 PM
 */
Class OrderServices
{
    /**
     * @param $userId
     * @param $aryCustomerInfo
     * @param $aryItems
     * @param $payment_method
     * @return mixed
     */
    public function createOrder($userId, $aryCustomerInfo, $aryItems, $payment_method = Orders::ORDER_PAYMENT_METHOD_IS_COD, $vouchers = [])
    {
        $orderAmount = $this->getOrderAmount($aryItems);
        $voucherAmount = $this->getVoucherAmount($vouchers);
        try {
            DB::beginTransaction();
            $order = new Orders();
            $order->user_id = $userId;
            $order->user_name = $aryCustomerInfo["full_name"];
            $order->phone_number = $aryCustomerInfo["phone"];
            $order->address = $aryCustomerInfo["address"];
            $order->note = $aryCustomerInfo["note"];
            $order->amount = $orderAmount["totalAmount"];
            $order->real_amount = $orderAmount["totalAmount"] - $orderAmount["totalDiscount"] - $voucherAmount;
            $order->created_by = 0;
            $order->status = Orders::ORDER_STATUS_IS_PENDING;
            $order->payment_method = $payment_method;
            $order->payment_status = Orders::ORDER_PAYMENT_STATUS_IS_PENDING;
            $order->save();

            foreach ($aryItems as $key => $value) {
                $aryItems[$key]["order_id"] = $order->id;
            }

            $aryOrderVouchers = [];
            foreach ($vouchers as $key => $voucher) {
                $aryOrderVouchers[$key]["order_id"] = $order->id;
                $aryOrderVouchers[$key]["voucher_id"] = $voucher["voucher_info"]["voucher_id"];
                $aryOrderVouchers[$key]["voucher_discount_type"] = $voucher["voucher_info"]["voucher_discount_type"];
                $aryOrderVouchers[$key]["voucher_discount_value"] = $voucher["voucher_info"]["voucher_discount_value"];
                $aryOrderVouchers[$key]["voucher_created_by"] = $voucher["voucher_info"]["voucher_created_by"];
                $aryOrderVouchers[$key]["voucher_start_date"] = $voucher["voucher_info"]["voucher_start_date"];
                $aryOrderVouchers[$key]["voucher_end_date"] = $voucher["voucher_info"]["voucher_end_date"];
                $aryOrderVouchers[$key]["created_at"] = date("Y-m-d H:i:s", time());
                $aryOrderVouchers[$key]["updated_at"] = date("Y-m-d H:i:s", time());
            }

            OrderVoucher::insert($aryOrderVouchers);
            OrderItem::insert($aryItems);
            DB::commit();
            return $order;

        } catch (\Exception $exception) {
            DB::rollBack();
            return [];
        }
    }

    /**
     * @param $aryItems
     * @return array
     */
    public function getOrderAmount($aryItems)
    {
        $totalAmount = $totalDiscount = 0;
        foreach ($aryItems as $item) {
            $totalAmount += ($item["quantity"] * $item["price"]);
            $totalDiscount += ($item["quantity"] * $item["promotion_discount"]);
        }

        return [
            'totalAmount' => $totalAmount,
            'totalDiscount' => $totalDiscount,
        ];
    }

    /**
     * @param $aryVoucher
     * @return int
     */
    public function getVoucherAmount($aryVoucher)
    {
        $amount = 0;
        foreach ($aryVoucher as $voucher) {
            $amount += $voucher['amount'];
        }

        return $amount;
    }
}