<?php

class HomeController extends BaseController {

	public function showConvertForm()
	{
		return View::make('convert');
	}

}
