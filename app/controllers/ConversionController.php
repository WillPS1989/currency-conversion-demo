<?php

class ConversionController extends \BaseController {
    /**
     * Take POST variables 'value', 'from' and 'to' currencies and do conversion
     *
     * @return array
     */
	public function ajaxConversion()
	{
        //remove non-numeric characters
		$value = (double) preg_replace("/[^0-9.]/", "", Input::get('value'));
		$from = Input::get('from');
		$to = Input::get('to');

		if ($from==$to){
		    //same currency given, no conversion
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
        return [
            'success' => 'true',
            'convertedValue' => $convertedValue,
            'conversionRate' => $conversionRate,
            'originalValue' => $value,
            'originalCurrency' => $from,
            'convertedCurrency' => $to
        ];
	}

}
