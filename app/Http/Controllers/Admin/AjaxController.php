<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Models\AttributeValue;
use App\Models\District;
use App\Models\RetailerAddress;
use Illuminate\Http\Request;

class AjaxController extends AppBaseController
{
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
	public function getStore(Request $request)
	{

		$request = $request->all();
		$query = RetailerAddress::with(["province", "districts"])->where('status', RetailerAddress::STORE_IS_AVAILABLE);

		if (isset($request["province"]) && $request["province"] > 0)
			$query = $query->where("province_id", $request["province"]);

		if (isset($request["district"]) && $request["district"] > 0)
			$query = $query->where("district_id", $request["district"]);

		$retailers = $query->get();

		$html = view("font_end.store.ajax", ["retailers" => $retailers])->render();

		return ["str" => $html, "retailerAddress" => $retailers];
	}
}
