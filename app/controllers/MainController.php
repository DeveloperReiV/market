<?php


namespace app\controllers;

use market\App;

class MainController extends AppController
{
	public function indexAction()
	{
		$this->setMeta(App::$app->getProperty('market_name'), 'Интернет магазин часов', 'Интернет магазин часов');
		$brands = \R::find('brand', 'LIMIT 3');
		$hits = \R::find('product', "`hit` = '1' AND `status` = '1' LIMIT 8");
		$this->set(compact('brands', 'hits'));
	}
}