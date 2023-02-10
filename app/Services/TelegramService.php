<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    const BOT_TOKEN = "1360991629:AAH-GziaXkUAlzoWK0bl4GCkl5kXzVlSelA";
    const BOT_BASE_URL = "https://api.telegram.org/bot" . self::BOT_TOKEN;
    const BOT_SENT_MESSAGE_END_POINT = "/sendMessage";

    public function __construct()
    {

    }

    /**
     * @param $message
     * @return array|mixed
     */
    public function sentMessage($message)
    {
        $params = [
            'chat_id' => -419411658,
            'text' => substr($message, 0, 500)
        ];

        $response = Http::get(self::BOT_BASE_URL . self::BOT_SENT_MESSAGE_END_POINT, $params);

        return $response->json();
    }

    public static function sent($message)
    {
        $params = [
            'chat_id' => -419411658,
            'text' => substr($message, 0, 500)
        ];

        $response = Http::get(self::BOT_BASE_URL . self::BOT_SENT_MESSAGE_END_POINT, $params);

        return $response->json();
    }

    /**
     * @param $message
     * @return mixed
     */
    public static function sentWishList($message)
    {
        $params = [
            'chat_id' => env("TELEGRAM_SENT_WISH_LIST"),
            'text' => $message
        ];

        $response = Http::get(self::BOT_BASE_URL . self::BOT_SENT_MESSAGE_END_POINT, $params);
        return $response->json();
    }

    public static function sentToBI($message)
    {
        $params = [
            'chat_id' => env("TELEGRAM_SENT_TOBI"),
            'text' => substr($message, 0, 500)
        ];

        $response = Http::get(self::BOT_BASE_URL . self::BOT_SENT_MESSAGE_END_POINT, $params);

        return $response->json();
    }
}
