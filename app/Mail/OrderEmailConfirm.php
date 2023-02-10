<?php

namespace App\Mail;

use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\OrderVoucher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmailConfirm extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var Orders
     */
    protected $order;

    /**
     * OrderEmailConfirm constructor.
     * @param Orders $order
     */
    public function __construct(Orders $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     * Gửi Mail Xác nhận đặt hàng thành công
     */
    public function build()
    {
        $items = OrderItem::with([
            "productVariant",
            "productVariant.productAttributeValue",
            "productVariant.productAttributeValue.attributeValue",
            "productVariant.productAttributeValue.attributeValue.attribute",
        ])->where("order_id", $this->order->id)->get();

        $vouchers = OrderVoucher::where("order_id", $this->order->id)->get();

        return $this->subject("Xác nhận đơn đặt hàng thành công tại Dem.vn")
            ->view('font_end.email.order_email_confirm')
            ->with([
                'id' => $this->order->id,
                'order' => $this->order,
                'userName' => $this->order->user_name,
                'phone' => $this->order->phone_number,
                'orderPrice' => $this->order->real_amount,
                'items' => $items,
                'vouchers' => $vouchers
            ]);
    }
}
