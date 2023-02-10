<?php

namespace App\Console\Commands;

use App\Models\District;
use App\Models\Province;
use App\Models\WishList;
use App\Services\TelegramService;
use Illuminate\Console\Command;

class CronSendWishList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendWishList';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->sendWishList();
        return true;
    }

    /**
     * @return bool
     * Update trạng thái khi đã send telegram
     */
    public function sendWishList()
    {
        $data = WishList::where("status_telegram", WishList::WID_LIST_CRON_STATUS_IS_NEW)
            ->where('time_send_telegram', '<=', time())
            ->get();

        foreach ($data as $val) {
            $items = json_decode($val->oder_item, true);
            $val->status_telegram = WishList::WID_LIST_CRON_STATUS_IS_DONE;
            $val->save();

            $provinces = Province::find($val->province_id);
            $dist = District::find($val->district_id);

            $message = "ID: " . $val->id;
            $message .= "\n Website: " . 'dem.vn';
            $message .= "\n Họ và tên: " . $val->full_name;
            $message .= "\n Email: " . $val->email;
            $message .= "\n Số điện thoại: " . $val->phone_number;
            $message .= "\n Địa chỉ: " . $val->address . " - " . $dist->name . " - " . $provinces->name;
            $message .= "\n Sản Phẩm: ";
            foreach ($items as $item) {
                $message .= "\n " . $item["product_name"] . ' x ' . $item["quantity"];
            }

            TelegramService::sentWishList($message);
        }

        return true;
    }
}
