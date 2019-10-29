<?php


namespace app\controllers;

use \app\controllers\AppController;
use market\App;
use market\Cache;

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