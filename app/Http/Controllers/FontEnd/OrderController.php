<?php

namespace App\Http\Controllers\FontEnd;

use App\Events\OrderSuccessSentTelegram;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Orders;
use App\Models\VNPayCallLogs;
use App\Models\WishList;
use App\Rules\CheckPhone;
use App\Services\OrderServices;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Province;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderEmailConfirm;

class OrderController extends AppBaseController
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
    public function checkOut()
    {
        $customer = session('customer');

        return view('font_end.cart.new_check_out')
            ->with("customer", $customer);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveCustomer(Request $request)
    {
        $request = $request->all();
        $messages = [
            'phone.required' => 'Vui lòng không bỏ trống',
            'full_name.required' => 'Vui lòng không bỏ trống',
            'address.required' => 'Vui lòng không bỏ trống'
        ];

        $validator = Validator::make($request, [
            'phone' => ['required', new CheckPhone()],
            'full_name' => 'required|string|max:100',
            'address' => 'required|string|max:250',
        ], $messages);

        $customer = [
            "phone" => $request["phone"],
            "full_name" => $request["full_name"],
            "address" => $request["address"],
            "note" => $request["note"]
        ];

        if ($validator->fails()) {

            return view('font_end.cart.new_check_out')
                ->with("customer", $customer)
                ->withErrors($validator);
        }

        session(['customer' => $customer]);
		$this->createWishList($customer);
        return redirect()->route("order.payment");
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payment()
    {
        $customer = session('customer');
        return view("font_end.order.new_payment")
            ->with("customer", $customer);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveOrder(Request $request)
    {
        $userId = 0;
        $vouchers = $this->getCartVouchers();
        $aryItems = $this->getCartItems();
        if (empty($aryItems))
            return redirect()->route("home");

        $customer = session('customer');
        if (Auth::check()) $userId = Auth::user()->id;

        $orderService = new OrderServices();
        $order = $orderService->createOrder(
            $userId,
            $customer,
            $aryItems,
            $request->payment_method ?? Orders::ORDER_PAYMENT_METHOD_IS_COD,
            $vouchers
        );

        if (empty($order)) {
            return redirect()
                ->back()
                ->withErrors(
                    "errors",
                    "Xin lỗi, chúng tôi không thể hoàn thành đơn hàng của bạn ngay lúc này vì hệ thống đang trong quá trình nâng cấp. Xin vui lòng thử lại sau!");
        };

        Cart::destroy();
        if (isset($request->payment_method) && $request->payment_method == Orders::ORDER_PAYMENT_METHOD_IS_COD) {

//            if (isset($order->email) && !empty($order->email))
//                Mail::to($order->email)->queue(new OrderEmailConfirm($order));
        }

        if (isset($request->payment_method) && $request->payment_method == Orders::ORDER_PAYMENT_METHOD_IS_INTERNET_BANKING) {

//            if (isset($order->email) && !empty($order->email))
//                Mail::to($order->email)->queue(new OrderEmailConfirm($order));
        }

        session(['orderSuccess' => $order->id]);
        if (isset($request->payment_method) && $request->payment_method == Orders::ORDER_PAYMENT_METHOD_IS_VNP) {
            $url = $this->vnPayCreateUrlPayment($order->id, $order->real_amount, $request->ip());
            return redirect($url);
        }

        if (isset($request->payment_method) && $request->payment_method == Orders::ORDER_PAYMENT_METHOD_IS_PAYOO)
            return redirect()->route("payoo.createUrlPayment", ["orderId" => $order->id]);


        OrderSuccessSentTelegram::dispatch($order);
        return redirect()->route("order.success");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function success(Request $request)
    {
        if ($request->vnp_ResponseCode != 00 && $request['vnp_Amount'] != $request->real_amount) {
            $data = $request->vnp_OrderInfo;
			$orderId = session('orderSuccess');
			$order = Orders::find($orderId);
			OrderSuccessSentTelegram::dispatch($order);
            return redirect()->route("order.cancel", ['data' => $data]);
        }
        if ($request->status != 1 && $request->totalAmount != $request->real_amount) {

			$orderId = session('orderSuccess');
			$order = Orders::find($orderId);
			OrderSuccessSentTelegram::dispatch($order);

            $data = 'Thanh toan cho don hang: ' . '' . $request->order_no;
            return redirect()->route("order.cancel", ['data' => $data]);
        }

        $orderId = session('orderSuccess');
        if (empty($orderId))
            return redirect()->route("home");

        $order = Orders::with([
            "items",
            "orderVoucher",
            "items.productVariant",
            "items.productImages",
        ])->find($orderId);
		$wishList = WishList::where("phone_number", $order->phone_number)->first();
		if (!empty($wishList)) {
			$wishList->status_telegram = WishList::WID_LIST_CRON_STATUS_IS_DONE;
			$wishList->save();
		}
        return view("font_end.order.new_success")->with("order", $order);

    }

    public function cancel(Request $request)
    {
        $data = $request->data;
        return view("font_end.order.cancel")->with('data', $data);
    }

    /**
     * @return array
     */
    public function getCartItems()
    {
        $aryItems = [];
        foreach (Cart::instance('default')->content() as $item) {
            list($productId, $product_variant_id) = explode("_", $item->id);
            $aryItems[] = [
                "product_id" => $productId,
                "product_variant_id" => $product_variant_id,
                "quantity" => $item->qty,
                "price" => $item->price,
                "promotion_id" => $item->options->promotion_id,
                "promotion_discount" => $item->options->promotion_discount,
            ];
        }
        return $aryItems;
    }

    /**
     * @return array
     */
    public function getCartVouchers()
    {
        $ary = [];
        foreach (Cart::instance('voucher')->content() as $voucher) {
            $ary[] = [
                "code" => $voucher->name,
                "amount" => $voucher->price,
                "voucher_info" => [
                    "voucher_id" => $voucher->id,
                    "voucher_discount_type" => $voucher->options->discount_type,
                    "voucher_discount_value" => $voucher->options->discount_value,
                    "voucher_created_by" => $voucher->options->created_by,
                    "voucher_start_date" => $voucher->options->start_date,
                    "voucher_end_date" => $voucher->options->end_date,
                ]
            ];
        }

        return $ary;
    }

    /**
     * @param $orderId
     * @param $orderAmount
     * @param $ipAddress
     * @return string
     * Tao url để redirect sang vnPay thanh toán
     */
    public function vnPayCreateUrlPayment($orderId, $orderAmount, $ipAddress)
    {
        $vnp_TmnCode = env("VNPAY_TMNCODE");
        $vnp_HashSecret = env("VNPAY_HASHSECRET");
        $vnp_Url = env("VNPAY_URL_PAYMENT");
        $vnp_ReturnUrl = route("order.success");

        $vnp_TxnRef = $orderId;
        $vnp_OrderInfo = "Thanh toan cho don hang " . $orderId;
        $vnp_OrderType = "billpayment";
        $vnp_Amount = (int)$orderAmount * 100;
        $vnp_Locale = "vn";
        $vnp_IpAddr = $ipAddress;
        $query = $hashData = "";

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        ksort($inputData);

        if (isset($vnp_BankCode) && $vnp_BankCode != "")
            $inputData['vnp_BankCode'] = $vnp_BankCode;

        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . $key . "=" . $value;
            } else {
                $hashData .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashData);
        return $vnp_Url . "?" . $query . 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
    }


    public function vnPayOrderUpdate(Request $request)
    {
        try {
            $data = $request->all();

            $vnpTranId = $data['vnp_TransactionNo'];
            $vnp_BankCode = $data['vnp_BankCode'];
            $orderId = $data['vnp_TxnRef'];
            $this->createVNPayCallLog($vnpTranId, $vnp_BankCode, $orderId, $request->all());

            $inputData = $returnData = array();
            foreach ($data as $key => $value) {
                if (substr($key, 0, 4) == "vnp_") {
                    $inputData[$key] = $value;
                }
            }

            $vnp_SecureHash = $inputData['vnp_SecureHash'];
            unset($inputData['vnp_SecureHashType']);
            unset($inputData['vnp_SecureHash']);
            ksort($inputData);

            $i = 0;
            $hashData = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashData = $hashData . '&' . $key . "=" . $value;
                } else {
                    $hashData = $hashData . $key . "=" . $value;
                    $i = 1;
                }
            }

            $secureHash = hash('sha256', env("VNPAY_HASHSECRET") . $hashData);
            if ($secureHash != $vnp_SecureHash) {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Chu ky khong hop le';
                return response()->json($returnData);
            }

            $order = Orders::find($orderId);

            if (!empty($order)) {

                if ($data['vnp_ResponseCode'] != 00) {
                    $order->payment_status = Orders::ORDER_PAYMENT_STATUS_IS_FAILS;
                    $order->save();
                    $returnData['RspCode'] = '00';
                    $returnData['Message'] = 'giao dich that bai';

                    return response()->json($returnData);
                }

                if ($data['vnp_Amount'] / 100 != $order->real_amount) {
                    $returnData['RspCode'] = '04';
                    $returnData['Message'] = 'so tien khong hop le';
                    return response()->json($returnData);
                }

                if ($order->payment_status == Orders::ORDER_PAYMENT_STATUS_IS_PENDING) {
                    $order->payment_status = Orders::ORDER_PAYMENT_STATUS_IS_COMPLETE;
                    $order->save();

                    if (isset($order->email) && !empty($order->email))
                        Mail::to($order->email)->queue(new OrderEmailConfirm($order));

                    OrderSuccessSentTelegram::dispatch($order);

                    $returnData['RspCode'] = '00';
                    $returnData['Message'] = 'Confirm Success';
                    return response()->json($returnData);
                }

                $returnData['RspCode'] = '02';
                $returnData['Message'] = 'Order already Confirmed';
                return response()->json($returnData);
            }
            $returnData['RspCode'] = '01';
            $returnData['Message'] = 'Order not found';
        } catch (\Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }

        return response()->json($returnData);
    }

    /**
     * @param $vnpTranId
     * @param $vnp_BankCode
     * @param $orderId
     * @param $aryRequest
     * @return bool
     */
    public function createVNPayCallLog($vnpTranId, $vnp_BankCode, $orderId, $aryRequest)
    {
        $vnPayLog = new VNPayCallLogs();
        $vnPayLog->order_id = $orderId;
        $vnPayLog->transaction_id = $vnpTranId;
        $vnPayLog->bank_code = $vnp_BankCode;
        $vnPayLog->data = json_encode($aryRequest);
        $vnPayLog->save();
        return true;
    }

	public function createWishList($customer)
	{

		$aryItems = [];
		foreach (Cart::instance("default")->content() as $item) {
			list($productId, $product_variant_id) = explode("_", $item->id);
			$aryItems[] = [
				"product_id" => $productId,
				"product_name" => $item->name,
				"product_variant_id" => $product_variant_id,
				"quantity" => $item->qty,
				"price" => $item->price,
				"promotion_id" => $item->options->promotion_id,
				"promotion_discount" => $item->options->promotion_discount,
			];
		}

		$data = WishList::where("phone_number", $customer["phone"])->first();

		if (empty($data)) {
			$data = new WishList();
			$data->phone_number = $customer["phone"];
		}

		$data->full_name = $customer["full_name"];
		$data->address = $customer["address"];
		$data->address = $customer["note"];
		$data->oder_item = json_encode($aryItems);
		$data->status_telegram = WishList::WID_LIST_CRON_STATUS_IS_NEW;
		$data->time_send_telegram = (time() + (60 * 5));
		$data->save();

		return $this->sendResponse($data, '');
	}
}
