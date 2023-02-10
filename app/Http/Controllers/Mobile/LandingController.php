<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\LandingContactForm;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Review;
use App\Models\Product;

class LandingController extends Controller
{
    public function index()
    {

        return view("landing.index");                   
    }

    public function nhanQua()
    {
        return view("landing.nhanqua");
    }

	public function postIndex(Request $request)
	{

		$messages = [
			'phone.required' => 'Số điện thoại là bắt buộc.',
			'name.required' => 'Tên là bắt buộc',
		];

		$validator = Validator::make($request->all(), [
			'phone' => 'required',
			'name' => 'required|string',
			'campain' => 'required|string',
		], $messages);

		if ($validator->fails()) {
			return redirect()
				->back()
				->withErrors($validator)
				->withInput();
		}

		$user = LandingContactForm::where("source", $request["campain"])
			->where("phone", $request["phone"])
			->count();

		if ($user)
			return redirect()->back()->with("success", "Đăng ký thành công.");

		$request = $request->all();
		$lading = new LandingContactForm();
		$lading->full_name = $request["name"];
		$lading->phone = $request["phone"];
		$lading->email ='1@dem.vn';
		$lading->source = $request["campain"];
		$lading->save();

		$message = "Đăng ký landing: \n Campain: " . $request["campain"];
		$message .= "\n Số điện thoại: " . $request["phone"];
		$message .= "\n Họ và tên: " . $request["name"];
		$telegram = new TelegramService();
		$telegram->sentToBI($message);

		return redirect()->back()->with("success", "Đăng ký thành công.");
	}

    public function landingGoodNight(){
		$product = Product::with(["images", "description"])->where("slug", "dem_foam_goodnight_massage_nhat_ban")->first();
        $reviews = Review::where('status', Review::REVIEW_IS_ACTIVE)
            ->where('entity_id', $product->id)
            ->with('getUser', 'reviewImage', 'getProduct')->get();    	
			return view("mobile.landing.goodnight")
        ->with("reviews", $reviews);
	}
}