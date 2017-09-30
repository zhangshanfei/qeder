<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\Category;
use app\models\Cart;
use app\models\Product;

class BaseController extends Controller
{
	public $layout = "main-layout";	
	protected $actions = ['*'];
	protected $except = [];
	protected $mustlogin = [];

	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'only' => $this->actions,
				'except' => $this->except,
				'rules' => [
					[
						'allow' => false,
						'actions' => empty($this->mustlogin) ? [] : $this->mustlogin,
						'roles' => ['?'],
					],
					[
						'allow' => true,
						'actions' => empty($this->mustlogin) ? [] : $this->mustlogin,
						'roles' => ['@'],
					],
				],
			],
		];
	}
	
	public function init()
	{
		\Yii::$app->session['cartnum']  = 0 ;
		$cart = Cart::find()->where(['or', 'sessionid = "' . \Yii::$app->session->id . '"', 'userid = ' . (\Yii::$app->user->id ? \Yii::$app->user->id : -1)])->asArray()->all();
		$cartnum = 0;
		foreach($cart as $k=>$pro){
			$cartnum = $cartnum + $pro['productnum'];
		}
		\Yii::$app->session['cartnum'] = $cartnum;
		$menu = Category::getMenu();
		$this->view->params['menu'] = $menu;
	}
}
