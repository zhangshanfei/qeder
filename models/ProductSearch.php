<?php
namespace app\models;

use yii\elasticsearch\ActiveRecord;

class ProductSearch extends ActiveRecord
{
	public function attributes()
	{
		return ["productid","title"];
	}

	public static function index()
	{
		return "qedertek_shop";
	}

	public static function type()
	{
		return "products";
	}
}
