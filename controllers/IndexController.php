<?php

namespace app\controllers;

use app\controllers\BaseController;
use app\modules\models\Setting;
use yii\helpers\ArrayHelper;

class IndexController extends BaseController
{
	protected $except = ['index'];
	public function actionIndex()
	{
		$setting = new Setting;
		$settings = $setting::find()->all();
		$settings = ArrayHelper::map($settings, 'key', 'value');
	
		return $this->render('index',['setting'=>$settings]);
	}
}
