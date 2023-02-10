<?php

namespace App\Widgets;

use App\Models\Voucher;
use Arrilot\Widgets\AbstractWidget;

class ShowVoucher extends AbstractWidget
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
		$Voucher = Voucher::where("status", Voucher::VOUCHER_STATUS_IS_ACTIVE)
			->where("start_date", "<=", time())
			->where("end_date", ">", time())
			->first();
		if (empty($Voucher)) return '';
		if($Voucher->status == Voucher::VOUCHER_STATUS_IS_ACTIVE)
			return '<div class="voucher">'. $Voucher->title.'</div>';
		return '';
	}
}
