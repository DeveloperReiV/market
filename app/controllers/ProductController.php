<?php


namespace app\controllers;


class ProductController extends AppController
{
	public function viewAction()
	{
		$alias = $this->route['alias'];
		$product = \R::findOne('product', "`alias` = ? AND `status` = '1'", [$alias]);

		if(!$product)
		{
			throw new \Exception("Страница '{$alias}' не найдена", 404);
		}
		else
		{

		}
	}
}