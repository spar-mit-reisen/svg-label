<?php

/**
 * User: sbraun
 * Date: 26.06.17
 * Time: 12:15
 */
class View_object extends stdClass
{
    public $target = [
        'x' => 54,
        'y' => 78,
        'text' => "zum Angebot",
    ];
    public $top = [
        'x' => 55,
        'y' => 16,
        'text' => "nur",
    ];
    public $price = [
        'x' => 84,
        'y' => 58,
    ];


    public $top_unit = " Ü/F ";
    public $top_nights = "1";
    public $price_value = "289";

    public function set_nights($nights) {
        $this->top_nights = $nights;
    }

    public function set_price($price_value) {
        if ($price_value < 100) {
            $this->price['x'] = 71;
        }
        if ($price_value > 999) {
            $this->price['x'] = 83;
        }
        $this->price_value = $price_value;
    }

    public function set_top_text($top_text) {
        $top_text = str_replace(['_'], [' '], $top_text);
        $this->top_text = $top_text;
    }

    public function set_bottom_text($bottom_text) {
        $bottom_text = str_replace(['_'], [' '], $bottom_text);
        $this->bottom_text = $bottom_text;
    }

    public function top_label() {
        if (empty($this->top_text))
            return $this->top_nights . $this->top_unit . $this->top['text'];
        else
            return $this->top_text;
    }

    public function bottom_label() {
        if (empty($this->bottom_text))
            return $this->target['text'];
        else
            return $this->bottom_text;
    }
}