<?php
namespace app\modules\controllers;

use app\modules\controllers\BaseController;
use app\modules\models\Setting;
use yii\helpers\ArrayHelper;
use Yii;

class SettingController extends BaseController
{
	public function actionIndex()
	{
	
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			foreach($post as $key => $value){
				Setting::updateAll(['value' => $value],['key' => $key]);
			}
		}
		$settingDate = Setting::find()->all();	
		$settings = ArrayHelper::map($settingDate, 'key', 'value');
		return $this->render('index',['settings' => $settings]);
	}
}
