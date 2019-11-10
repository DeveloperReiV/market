<?php


namespace app\controllers;


use market\App;

class CurrencyController extends AppController
{
	public function changeAction()
	{
		$currency = !empty($_GET['curr']) ? $_GET['curr'] : null;
		if($currency)
		{
			$curr = App::$app->getProperty('currencies')[$currency];
			if(!empty($curr))
			{
				setcookie('currency', $currency, time() + 3600 * 24 * 7, '/');
			}
		}
		redirect();
	}
}