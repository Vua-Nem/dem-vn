<?php

namespace App\Listeners;

use App\Events\OrderSuccessSentTelegram;
use App\Models\District;
use App\Models\OrderItem;
use App\Models\Province;
use App\Services\TelegramService;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Orders;

class SendTelegramMessage implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderSuccessSentTelegram $event
     * @return void
     */
    public function handle(OrderSuccessSentTelegram $event)
    {

		$provinces = Province::find($event->order->province_id);
		$dist = District::find($event->order->district_id);

		$orderItems = OrderItem::with("productVariant")->where("order_id", $event->order->id)->get();
		$message = "Đơn hàng mới: \n ID: " . $event->order->id;
		$message .= "\n Website: " . 'dem.com';
		$message .= "\n Họ và tên: " . $event->order->user_name;
		$message .= "\n Email: " . $event->order->email;
		$message .= "\n Số điện thoại: " . $event->order->phone_number;
		$message .= "\n Địa chỉ: " . $event->order->address . " - " . $dist->name . " - " . $provinces->name;
		$message .= "\n Giá niêm yết: " . number_format($event->order->amount,0,',','.');
		if($event->order->payment_method == Orders::ORDER_PAYMENT_METHOD_IS_COD){
			$message .= "\n Giá phải trả: " . number_format($event->order->real_amount,0,',','.');
			$message .= "\n Phương thức thanh toán: " . 'thanh toán qua COD';
		}elseif($event->order->payment_method == Orders::ORDER_PAYMENT_METHOD_IS_VNP){
			$message .= "\n Giá phải trả: " . number_format($event->order->real_amount,0,',','.');
			$message .= "\n Phương thức thanh toán: " . 'thanh toán qua VNP';
		}else{
			$message .= "\n Giá phải trả: " . number_format($event->order->real_amount,0,',','.');
			$message .= "\n Phương thức thanh toán: " . 'thanh toán qua Payoo';
		}


        if ($event->order->payment_status == 1) {
            $status = "Chờ thanh toán";
        } elseif ($event->order->payment_status == 2) {
            $status = "Đã thanh toán";
        } else {
            $status = "Thất bại";
        }

        $message .= "\n Trạng thái thanh toán: " . $status;
        $message .= "\n Sản Phẩm: ";

        foreach ($orderItems as $item) {
            $message .= "\n " . $item->productVariant->name . ' x ' . $item->quantity;
        }

        $telegram = new TelegramService();
        $telegram->sentToBI($message);
    }
}
