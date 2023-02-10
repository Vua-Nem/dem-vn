<?php

namespace App\Http\Controllers\FontEnd;

use App\Http\Controllers\AppBaseController;

class WPHeaderController extends AppBaseController
{
    public function index()
    {
        $mobileHeader = view("api.mobile.header")->render();
        $header = view("api.header")->render();
        $footer = view("api.footer")->render();
        return $this->sendSuccess([
            "header" => $header,
            "mobile_header" => $mobileHeader,
            "footer" => $footer
        ]);
    }
}
