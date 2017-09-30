<?php
namespace app\controllers;

use app\controllers\BaseController;
use app\models\Product;
use app\models\Influencer;
use yii\helpers\Url;

class InformationController extends BaseController
{
	protected $except = ['about','promotion','support','giveaway','sale','deals','influencer','captcha','activity'];
	public function actions()
	{
		return [
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public function actionAbout()
	{
		return $this->render('about');	
	}

	public function actionPromotion()
	{
	//	$prods = new Product();
		$recPro = Product::find()->where("isrec = '1'")->andwhere("ison = '1'")->limit(8)->all();
		$salPro = Product::find()->where("issale = '1'")->andwhere("ison = '1'")->limit(8)->all();
		return $this->render('promotion',['recPro' => $recPro,'salPro'=> $salPro,'page' => 0]);
	}
	
	public function actionGiveaway()
	{
	//	$prods = new Product();
		$recPro = Product::find()->where("isrec = '1'")->andwhere("ison = '1'")->limit(8)->all();
		$salPro = Product::find()->where("issale = '1'")->andwhere("ison = '1'")->limit(8)->all();
		return $this->render('promotion',['recPro' => $recPro,'salPro'=> $salPro,'page' => 0]);
	}

	public function actionSale()
	{
	//	$prods = new Product();
		$recPro = Product::find()->where("isrec = '1'")->andwhere("ison = '1'")->limit(8)->all();
		$salPro = Product::find()->where("issale = '1'")->andwhere("ison = '1'")->limit(8)->all();
		return $this->render('promotion',['recPro' => $recPro,'salPro'=> $salPro,'page'=>1]);
	}

	public function actionDeals()
	{
	//	$prods = new Product();
		$recPro = Product::find()->where("isrec = '1'")->andwhere("ison = '1'")->limit(8)->all();
		$salPro = Product::find()->where("issale = '1'")->andwhere("ison = '1'")->limit(8)->all();
		return $this->render('promotion',['recPro' => $recPro,'salPro'=> $salPro,'page' => 2]);
	}

	public function actionSupport()
	{
		return $this->render('support');
	}
	

	public function actionInfluencer()
	{
		$model = new Influencer();
		$country = \Yii::$app->params['country'];
		if(\Yii::$app->request->isPost){
			$post = \Yii::$app->request->post();
			$model->createtime = time();
			if($model->add($post)){
				\Yii::$app->session->setFlash('influencerinfo','Submit Success!');
			}
		}
		return $this->render('influencer',['model' => $model,'country' => $country]);
	}

	//张善飞 code QQ3460698227
	//返回打地鼠的游戏视图
	public function actionMousehit()
	{
		return $this->render('mousehit');
	}

}
