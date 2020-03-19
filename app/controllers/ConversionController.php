<?php

class ConversionController extends \BaseController {

	public function ajaxConversion()
	{
		$value = (double) preg_replace("/[^0-9.]/", "", Input::get('value')); //remove non-numeric characters
		$from = Input::get('from');
		$to = Input::get('to');

		if ($from==$to){
		    $conversionRate = 1;
        } else {
            $fxRate = FXRates::getByFromTo($from, $to);
            if(!count($fxRate)){
                //no valid conversion found
                return ['success' => 'false'];
            } else {
                $conversionRate = $fxRate->conversion_rate;
            }
        }

        $convertedValue = $value * $conversionRate;
        return ['success' => 'true', 'convertedValue' => $convertedValue, 'conversionRate' => $conversionRate, 'originalValue' => $value, 'originalCurrency' => $from, 'convertedCurrency' => $to];
	}

}
