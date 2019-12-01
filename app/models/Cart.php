<?php


namespace app\models;

use market\App;

class Cart extends AppModel
{
	public function addToCart($product, $qty = 1, $mod = null){
		if(!isset($_SESSION['cart.currency'])){
			$_SESSION['cart.currency'] = App::$app->getProperty('currency');
		}
		if($mod){
			$ID = "{$product->id}-{$mod->id}";
			$title = "{$product->title} ($mod->title)";
			$price = $mod->price;
		}else{
			$ID = $product->id;
			$title = $product->title;
			$price = $product->price;
		}
		if(isset($_SESSION['cart'][$ID])){
			$_SESSION['cart'][$ID]['qty'] += $qty;
		}else{
			$_SESSION['cart'][$ID] = [
				'qty' => $qty,
				'title' => $title,
				'price' => $price * $_SESSION['cart.currency']['value'],
				'alias' => $product->alias,
				'img' => $product->img,
			];
		}

		$_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
		$_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * ($_SESSION['cart.currency']['value'] * $price): $qty * ($_SESSION['cart.currency']['value'] * $price);
	}

	public function deleteItem($id){
		$qtyMinus = $_SESSION['cart'][$id]['qty'];
		$sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
		$_SESSION['cart.qty'] -= $qtyMinus;
		$_SESSION['cart.sum'] -= $sumMinus;
		unset($_SESSION['cart'][$id]);
	}
}