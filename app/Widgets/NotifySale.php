<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class NotifySale extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $query = \App\Models\NotifySale::query();

        if (isset($this->config['product_id']))
            $query = $query->where("product_id", $this->config['product_id']);
        $content = $query->where('status', \App\Models\NotifySale::ACTIVE)->first();

        if (empty($content)) return '';

        return view('widgets.notify_sale')->with("content", $content);
    }
}
