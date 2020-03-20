<?php

class FXRates extends \Eloquent {
    protected $table = 'FXRates';
    /**
     * Get a conversion_rate from a 'from' currency and a 'to' currency
     *
     * @param $from
     * @param $to
     * @return mixed
     */
    public static function getByFromTo($from, $to)
    {
        return self::select('conversion_rate')->where(['from' => $from, 'to' => $to])->first();
    }

    /**
     * Get a unique list of values from the 'from' or 'to' columns
     *
     * @param $column
     * @return mixed
     * @throws Exception
     */
    public static function getCurrencies($column)
    {
        if ($column != 'from' && $column != 'to'){
            throw new Exception('Called a column other than from or to');
        }
        return self::select($column)->orderBy($column, 'asc')->groupBy($column)->get();
    }
}