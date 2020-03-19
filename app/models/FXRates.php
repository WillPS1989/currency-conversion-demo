<?php

class FXRates extends \Eloquent {
    protected $table = 'FXRates';

    public static function getByFromTo($from, $to)
    {
        return self::select('conversion_rate')->whereRaw('`from` = "' . $from  . '" and `to` = "' .$to. '"')->first();
    }

    public static function getCurrencies($column)
    {
        if ($column != 'from' && $column != 'to'){
            throw new Exception('Called a column other than from or to');
        }
        return self::select($column)->orderBy($column, 'asc')->groupBy($column)->get();
    }
}