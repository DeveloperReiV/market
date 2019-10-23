<?php


namespace market\base;

use market\DB;

abstract class Model
{
	public $attributes = [];
	public $errors = [];
	public $rules = [];

	public function __construct()
	{
		DB::instance();
	}
}