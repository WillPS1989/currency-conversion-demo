<?php

class FXRates extends \Eloquent {
    protected $table = 'FXRates';

    public static function getConversionRate($from, $to)
    {
        $rate = self::whereRaw('`from` = "' . $from  . '" and `to` = "' .$to. '"')->first();

        return $rate->conversion_rate;
    }
}