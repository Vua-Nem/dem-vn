<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\RetailerAddress;
use Illuminate\Http\Request;

class StoreController extends Controller
{
	public function index()
	{
		$retailerAddress = RetailerAddress::with(["province", "districts"])
			->where('status', RetailerAddress::STORE_IS_AVAILABLE)
			->get();

		$aryProvince = $aryStores = [];
		foreach ($retailerAddress as $store) {
			$aryProvince[$store->province->id] = $store->province->name;
		}
		asort($aryProvince);
		return view('mobile.store.index')
			->with('provinces', $aryProvince)
			->with('districts', $retailerAddress)
			->with('retailerAddress', $retailerAddress);
	}

}
