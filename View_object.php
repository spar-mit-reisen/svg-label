<?php

/**
 * User: sbraun
 * Date: 26.06.17
 * Time: 12:15
 */
class View_object extends stdClass
{
    public $target = [
        'x' => 65,
        'y' => 90,
        'text' => "zum Angebot",
    ];
    public $top = [
        'x' => 68,
        'y' => 19,
        'text' => "nur",
    ];
    public $top_unit = " Ü/F ";
    public $top_nights = "5";
    public $price = "189";

    public function set_nights($nights) {
        $this->top_nights = $nights;
    }

    public function set_price($price) {
        $this->price = $price;
    }

    public function top_label() {
        return $this->top_nights . $this->top_unit . $this->top['text'];
    }
}