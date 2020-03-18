<?php

class ConversionController extends \BaseController {


	public function conversion()
	{
		$value = (double) Input::get('value');
		$from = Input::get('from');
		$to = Input::get('to');

        $conversionRate = (double) FXRates::getConversionRate($from, $to);
        $convertedValue = $value * $conversionRate;

        echo $convertedValue;
	}

}
