<?php


namespace app\controllers;

use \app\controllers\AppController;
use market\App;
use market\Cache;

class MainController extends AppController
{
	public function indexAction()
	{
		$posts = \R::findAll('test');
		$this->setMeta(App::$app->getProperty('market_name'), 'des', 'key');
		$name = 'alex';
		$age = 55;

		$cache = Cache::instance();
		$data = $cache->get('test');
		if(!$data)
		{
			$cache->set('test', $name);
		}

		$this->set(compact('name', 'age', 'posts'));

	}
}