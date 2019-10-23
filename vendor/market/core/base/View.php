<?php


namespace market\base;


use mysql_xdevapi\Exception;

class View
{
	public $route;
	public $controller;
	public $model;
	public $view;
	public $prefix;
	public $layout;
	public $data = [];
	public $meta = [];

	public function __construct($route, $layout = '', $view = '', $meta)
	{
		$this->route = $route;
		$this->controller = $route['controller'];
		$this->model = $route['controller'];
		$this->view = $view;
		$this->prefix = $route['prefix'];
		$this->meta = $meta;

		if($layout === false)
		{
			$this->layout = false;
		}
		else
		{
			$this->layout = $layout ?: LAYOUT;
		}
	}

	public function render($data)
	{
		if(is_array($data))
		{
			extract($data);
		}

		$viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php";

		if(is_file($viewFile))
		{
			ob_start();
			require_once $viewFile;
			$content = ob_get_clean();
		}
		else
		{
			throw  new \Exception("Не найден вид {$viewFile}", 500);
		}

		if(false !== $this->layout)
		{
			$layoutFile = APP . "/views/layouts/{$this->layout}.php";

			if(is_file($layoutFile))
			{
				require_once $layoutFile;
			}
			else
			{
				throw  new \Exception("Не найден шаблон {$layoutFile}", 500);
			}
		}
	}

	function getMeta()
	{
		return <<<HTML
		<title>{$this->meta['title']}</title>
		<meta name="description" content="{$this->meta['description']}">
		<meta name="keywords" content="{$this->meta['keywords']}">
HTML;

	}
}