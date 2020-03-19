<?php

class FXRates extends \Eloquent {
    protected $table = 'FXRates';

    public static function getByFromTo($from, $to)
    {
        return self::whereRaw('`from` = "' . $from  . '" and `to` = "' .$to. '"')->first();
    }
}