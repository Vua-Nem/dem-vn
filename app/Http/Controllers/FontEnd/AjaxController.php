<?php

namespace App\Http\Controllers\FontEnd;

use App\Http\Controllers\AppBaseController;
use App\Models\AttributeValue;
use App\Models\District;
use App\Models\RetailerAddress;
use Illuminate\Http\Request;

class AjaxController extends AppBaseController
{
    /**
     * @param Request $request
     * @return string
     */
    public function getAttributeValue(Request $request)
    {
    	
        if (!isset($request->attribute_id))
            return '';

        $attributeValues = AttributeValue::where("attribute_id", $request->attribute_id)->get();
        $str = '<option value="0">No select</option>';
        foreach ($attributeValues as $value) {
            $str .= '<option value="' . $value->id . '">' . $value->value . '</option>';
        }

        return $str;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getDistrict(Request $request)
    {
        if (!isset($request->id)) return '';

        $districts = District::where("province_id", $request->id)->get();

        if ($districts->count() == 0) return '';

        $str = '';

        foreach ($districts as $district) {
            $str .= '<option value="' . $district->id . '">' . $district->name . '</option>';
        }

        return $str;
    }

	public function getStoreDistrict(Request $request)
	{
		$request = $request->all();

		$retailerAddress = RetailerAddress::with(["province", "districts"])
			->where('status', RetailerAddress::STORE_IS_AVAILABLE)
			->where("province_id", $request["id"] ?? 0)
			->get();
		$aryDistricts = [];
		foreach ($retailerAddress as $val) {
			$aryDistricts[$val->district_id] = $val->districts->name;
		}

		$str = '';

		foreach ($aryDistricts as $key => $district) {
			$str .= '<option value="' . $key . '" class="district-get">' . $district . '</option>';
		}

		return $str;
	}
}
