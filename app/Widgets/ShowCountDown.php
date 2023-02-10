<?php

namespace App\Widgets;

use App\Models\CountDown;
use Arrilot\Widgets\AbstractWidget;

class ShowCountDown extends AbstractWidget
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
      $query = CountDown::query();

      if (isset($this->config["entity_type"]) && $this->config["entity_type"] == 1) {

        $query = $query->where("entity_type", $this->config["entity_type"])
          ->where("status", CountDown::ACTIVE);

      } else if (isset($this->config["entity_id"]) && isset($this->config["entity_type"]) && $this->config["entity_type"] == 2) {

          $query = $query->where("entity_id", $this->config["entity_id"])
            ->where("entity_type", $this->config["entity_type"])
            ->where("status", CountDown::ACTIVE);

      }
        
      $countDown = $query->first();
      if(isset($countDown))
        return view('widgets.show_count_down', [
          'countDowns' => $countDown,
        ]);
      return '';
    }
}
