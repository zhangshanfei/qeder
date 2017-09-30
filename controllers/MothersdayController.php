<?php
namespace app\controllers;

use app\controllers\BaseController;
use app\models\Address;
use app\models\Mothersday;

class MothersdayController extends BaseController
{
	protected $except = ['index'];
	public function actionIndex()
	{
		$userid = \Yii::$app->user->id;
		$data = Mothersday::find()->where('userid = :id',[':id'=>$userid])->one();
		if($data){
			if($data['award']){
				return $this->redirect(['mothersday/prize']);
			}
		}
		return $this->render("index");
	}

	public function actionPrize()
	{
		$userid = \Yii::$app->user->id;
		$award = \Yii::$app->request->get('award');		
		$model = Address::find()->where('userid = :id',[':id'=>$userid])->one();
		$data = Mothersday::find()->where('userid = :id',[':id'=>$userid])->one();
		//var_dump($data);exit;
		if(empty($data)){
			return $this->redirect(['mothersday/index']);
		}
		if(isset($award)){
			Mothersday::updateAll(['award'=> $award],'userid = :id',[':id' => $userid]);
		}
		$award = Mothersday::find()->where('userid = :id',[':id'=>$userid])->one()['award'];
		if(!$model){
			$model = new Address;
		}
		if($award ==1){
			return $this->render("product_free",['model' => $model]);	
		}else{		
			return $this->render("product",['model' => $model,'award' => $award]);	
		}
	}

	public function actionStatus()
	{
		$userid = \Yii::$app->user->id;
		$model = Mothersday::find()->where('userid = :id',[':id'=>$userid])->one();
		if(!$model){
			$model = new Mothersday();
			$model->userid = \Yii::$app->user->id;
			$model->createtime = time();
		}
		$status = \Yii::$app->request->get('click');		
		$model->status = $status;
		$model->save();
	}
}
