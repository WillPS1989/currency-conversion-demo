<?php

class HomeController extends BaseController {

	public function showConvertForm()
	{
        $fromCurrencies = FXRates::getCurrencies('from');
        $toCurrencies = FXRates::getCurrencies('to');

		return View::make('convert')->with(['fromCurrencies' => $fromCurrencies, 'toCurrencies' => $toCurrencies]);
	}

}
