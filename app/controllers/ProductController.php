<?php


namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Product;

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
			$this->setMeta($product->title, $product->description, $product->keywords);

			//Хлебные крошки
			$breadcrumbs = Breadcrumbs::getBreadcrumbs($product->category_id, $product->title);

			//Связанные товары
			$related = \R::getAll("SELECT * FROM `related_product` JOIN `product` ON product.id = related_product.related_id WHERE related_product.product_id = ?", [$product->id]);

			//Запись в куки запрошенного товара
			$p_modal = new Product();
			$p_modal->setRecentlyViewed($product->id);

			//Просмотренные товары
			$r_viewed = $p_modal->getRecentlyViewed();
			$recentlyViewed = null;
			if($r_viewed){
				$recentlyViewed = \R::find('product', 'id IN (' . \R::genSlots($r_viewed) . ') LIMIT 3', $r_viewed);
			}

			//Галерея
			$gallery = \R::findAll('gallery', 'product_id = ?', [$product->id]);

			//Модификации
			$mods = \R::findAll('modification', 'product_id = ?', [$product->id]);

			$this->set(compact('product', 'related', 'gallery', 'recentlyViewed', 'breadcrumbs', 'mods'));
		}
	}
}