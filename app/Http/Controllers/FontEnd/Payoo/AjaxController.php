<?php

namespace App\Http\Controllers\Web\Payoo;

use App\Http\Controllers\AppBaseController;
use App\Models\PartialPaymentFee;
use Illuminate\Http\Request;

class AjaxController extends AppBaseController
{
    /**
     * @param Request $request
     * @return string
     *  "price" => "5704350"
     *  "bank_id" => "1"
     *  "month" => "3"
     */
    public function getPriceRulesPay(Request $request)
    {
        $price = $request->price;
        $month = $request->month;
        $bank_id = $request->bank_id;
        if (isset($price) < 3000000) {
            return ["status" => false];
        }

        $level = $this->getLevel($price);
        $newPrice = $price - ($price * 0.3);

        $level_mth = "level" . $level . "_" . $month;
        $dataPay = PartialPaymentFee::where('bank_id', $bank_id)->get()->first();
        $percent = $dataPay->$level_mth;

        $pricePay = $price / 12 + $newPrice * $percent / 100;

        return $pricePay;
    }

    /**
     * @param Request $request
     * @return float|int|mixed
     * Trả góp từ
     */
    function getTotalPayHomepage(Request $request)
    {
        $request = $request->all();

        if ($request["price"] < 3000000)
            return $request["price"];

        $level = $this->getLevel($request["price"]);
        $newPrice = $request["price"] - ($request["price"] * 0.3);
        $level_mth = "level" . $level . "_12";

        $percent = PartialPaymentFee::where($level_mth, '>', 0)
            ->where($level_mth, '!=', 'x')
            ->min($level_mth);

        $pricePay = ($newPrice / 12) + ($newPrice * $percent) / 100;

        return $pricePay;
    }


    function getLevel($price)
    {
        if ($price > 3000000 && $price < 10000000)
            return 1;

        if ($price >= 1000000 && $price < 15000000)
            return 2;

        if ($price >= 15000000 && $price < 25000000)
            return 3;

        if ($price >= 25000000)
            return 4;

        return 0;
    }


} 
