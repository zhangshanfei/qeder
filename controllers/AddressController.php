<?php 
namespace app\controllers;
use app\controllers\BaseController;
use Yii;
use app\models\Address;

class AddressController extends BaseController
{
	public function actionIndex()
	{
		$this->render("address");
	}
}
