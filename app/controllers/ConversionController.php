<?php

class ConversionController extends \BaseController {

	public function conversion()
	{
		$value = (double) Input::get('value');
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
        return ['success' => 'true', 'convertedValue' => $convertedValue, 'conversionRate' => $conversionRate];
	}

}
