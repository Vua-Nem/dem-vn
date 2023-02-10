<?php

namespace App\Http\Controllers\Mobile\Payoo;

use App\Events\OrderSuccessSentTelegram;
use App\Http\Controllers\Controller;
use App\Mail\OrderEmailConfirm;
use App\Models\PayooCallLog;
use App\Models\PayooIpnErrorLog;
use App\Services\PayooNotify;
use App\Services\PayoooService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Orders;
use App\Repositories\PayooCallLogRepository;
use Illuminate\Support\Facades\Mail;

class PayooController extends Controller
{
	private $payooCallLogRepository;
	private $username;
	private $shop_id;
	private $shop_title;
	private $shop_domain;
	private $key;
	private $notify_url;
	private $shop_back_url;
	protected $url;
	private $payoo_payment_api;


	public function __construct(PayooCallLogRepository $payooCallLogRepo)
	{
		$this->shop_domain = env('SHOP_DOMAIN');
		$this->shop_back_url = route("order.success");
		$this->notify_url = route("payoo.ipn");
		$this->username = env('PAYOO_BUSINESSUSERNAME');
		$this->shop_id = env('PAYOO_SHOPID');
		$this->key = env('PAYOO_SECRETKEY');
		$this->payoo_payment_api = env('PAYOO_PAYMENTAPI');
		$this->shop_title = "Vua Nệm";
		$this->payooCallLogRepository = $payooCallLogRepo;
	}

	public function Index(Request $request)
	{
		echo hash('sha512', env('PAYOO_SECRETKEY'));
		return view('test');
	}

	/**
	 * @param $orderId
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 *
	 */
	public function createUrlPayment($orderId)
	{
		$order = Orders::with("items.productVariant")->find($orderId);
		$orderDetails = "Mã đơn hàng: [" . $order->id . "] <br>Tổng số tiền cần thanh toán:";
		$orderDetails .= price($order->real_amount) . "<br>Sản phẩm: ";
		foreach ($order->items as $item) {
			$orderDetails .= $item->productVariant->name . "</br>";
		}

		$urlPayment = $this->RequestPaymentAPI(
			$order,
			date('d/m/Y'),
			0,
			$order->real_amount,
			$orderDetails,
			date('YmdHis', strtotime('+1 day', time()))
		);

		return redirect($urlPayment);
	}

	/**
	 * @param $order
	 * @param $order_ship_date
	 * @param $order_ship_days
	 * @param $order_cash_amount
	 * @param $order_detail
	 * @param $validity_time
	 * @return array|string
	 * Tạo ra một cái link để chuyển khách hàng sang bên payoo thanh toán tiếp
	 */
	public function RequestPaymentAPI($order, $order_ship_date, $order_ship_days, $order_cash_amount, $order_detail, $validity_time)
	{
		$str = '<shops><shop><session>';
		$str .= $order->id . '</session><username>' . $this->username;
		$str .= '</username><shop_id>' . $this->shop_id;
		$str .= '</shop_id><shop_title>' . $this->shop_title;
		$str .= '</shop_title><shop_domain>' . $this->shop_domain;
		$str .= '</shop_domain><shop_back_url>' . $this->shop_back_url;
		$str .= '</shop_back_url><order_no>' . $order->id;
		$str .= '</order_no><order_cash_amount>' . $order_cash_amount;
		$str .= '</order_cash_amount><order_ship_date>' . $order_ship_date;
		$str .= '</order_ship_date><order_ship_days>' . $order_ship_days;
		$str .= '</order_ship_days><order_description>' . urlencode($order_detail);
		$str .= '</order_description><validity_time>' . $validity_time;
		$str .= '</validity_time><notify_url>' . $this->notify_url;
		$str .= '</notify_url><customer><name>' . $order->user_name;
		$str .= '</name><phone>' . $order->phone_number;
		$str .= '</phone><address>' . $order->address;
		$str .= '</address><city>' . $order->province->name;
		$str .= '</city><email>' . $order->email;
		$str .= '</email></customer></shop></shops>';
		$checksum = hash('sha512', $this->key . $str);
		$data = [
			'data' => $str,
			'checksum' => $checksum,
			'refer' => $this->shop_domain
		];

		$response = Http::timeout(10)->POST($this->payoo_payment_api, $data);
		$response = json_decode($response);
		$url = $response->order->payment_url . '#installment';
		return $url;
	}

	public function pIpn(Request $request)
	{
		$request = $request->all();
		$NotifyMessage = stripcslashes($request["NotifyData"]);
		if ($NotifyMessage == null || '' === $NotifyMessage)
			return 'NotifyData is null or empty!';

		$listener = new PayoooService($NotifyMessage);
		$signature = $listener->GetSignature();
		$invoice = $listener->GetPaymentNotify();
		$keyFields = $listener->GetKeyFields();
		if ($this->verifyChecksum($invoice, $keyFields, $signature) == TRUE) {

			$this->createPayooCallbackLog($invoice);

			$order = Orders::find($invoice->OrderNo);
			if($order->payment_status == Orders::ORDER_PAYMENT_STATUS_IS_PENDING)
			{
				if (isset($order->email) && !empty($order->email))
					Mail::to($order->email)->queue(new OrderEmailConfirm($order));

				OrderSuccessSentTelegram::dispatch($order);

				$order->payment_status = Orders::ORDER_PAYMENT_STATUS_IS_COMPLETE;
				$order->save();
			}

			if ($invoice->getState() == 'PAYMENT_RECEIVED')
				return 'NOTIFY_RECEIVED';
		}
		if($invoice->OrderCashAmount != $order->real_amount)
		{
			return 'số tiền không hợp lệ!';
		}

		return 'Verified is faillure.';
	}

	public function createPayooCallbackLog($invoice)
	{
		$model = new PayooCallLog();
		$model->order_id = $invoice->OrderNo;
		$model->transaction_id = $invoice->OrderNo;
		$model->bank_code = 'Payoo';
		$model->data = json_encode($invoice);
		$model->save();
	}

	/**
	 * @param $order_id
	 * @param $message
	 * @return bool
	 */
	public function createIPNErrorLog($order_id, $message)
	{
		$model = new PayooIpnErrorLog();
		$model->order_id = $order_id;
		$model->error = $message;
		$model->save();
		return true;
	}



	function verifyChecksum($dataResponse, $keyFields, $signature)
	{
		$strData = env('PAYOO_SECRETKEY');
		if (!empty($keyFields)) {
			$arr_Keys = explode('|', $keyFields);
			for ($i = 0; $i < count($arr_Keys); $i++) {
				$strData .= '|' . $dataResponse->{$arr_Keys[$i]};
			}
		}

		if (strtoupper(hash('sha512', $strData)) != strtoupper($signature)) {
			return FALSE;
		}

		return TRUE;
	}
}
