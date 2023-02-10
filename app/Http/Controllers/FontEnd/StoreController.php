<?php

namespace App\Http\Controllers\FontEnd;

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
		return view('font_end.store.index')
			->with('provinces', $aryProvince)
			->with('districts', $retailerAddress)
			->with('retailerAddress', $retailerAddress);
	}

	public function ajaxGetStoreDistance(Request $request)
	{

		$request = $request->all();
		$retailers = RetailerAddress::with(["province", "districts"])->where('status', RetailerAddress::STORE_IS_AVAILABLE)->get();

		foreach ($retailers as $retailer) {
			if ($retailer->latitude)
				$distance = $this->getDistance($request["latitude"], $request["longitude"], $retailer->latitude, $retailer->longitude);
			$retailer->distance = round($distance, 2);
		}

		$html = view("font_end.store.ajax", ["retailers" => $retailers->sortBy("distance")])->render();
		pd($html);
		return ["str" => $html, "retailerAddress" => $retailers];

	}

}
