<?php
namespace app\controllers;

use app\models\User;
use app\models\Profile;
use app\models\Cart;
use app\models\Order;
use app\models\OrderDetail;
use yii\web\Controller;
use yii\bootstrap\ActiveForm;
use app\models\Address;
use Yii;

class AccountController extends BaseController
{
	protected $except = ['login','create','logout','forget','password','auth'];
	public $oldSessionid = "";	
	public function actions()
	{
		return [
			'auth' => [
				'class' => 'yii\authclient\AuthAction',
				'successCallback' => [$this,'successCallback'],
				],
			];
	}

	public function successCallback($client)
	{
		$attributes = $client->getUserAttributes();
	        if ($model = User::find()->where('openid = :openid', [':openid' => $attributes['id']])->one()) {
			Yii::$app->user->login($model);
			$data = Profile::find()->where('userid = :userid',[':userid' => Yii::$app->user->id])->one();
			Yii::$app->session['username'] = !empty($data['username']) ? $data['username'] : $attributes['name'];
		}else{
			$model = new User();
			$model->username = $attributes['name'];
			$model->useremail = $attributes['email'];
			$model->openid = $attributes['id'];
			$model->createtime = time();
			$model->userpass =  Yii::$app->getSecurity()->generatePasswordHash('123456');
			$model->save();
			Yii::$app->user->login($model);
			Yii::$app->session['username'] = $attributes['name'];
		}

	}


	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionLogin()
	{
		$model = new User;
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			$this->oldSessionid = Yii::$app->session->id;
			 if (Yii::$app->request->get('returnUrl')) {
		            Yii::$app->user->setReturnUrl(Yii::$app->request->get('returnUrl'));
       			 }
			if($model->login($post)){
				//return $this->redirect(['/']);
				(new Cart())->modSession($this->oldSessionid);	
				$data = Profile::find()->where('userid = :userid',[':userid' => Yii::$app->user->id])->one();
				$session = Yii::$app->session;
				$session['username'] = $data['username'];
				return $this->goBack();
				//if(substr(Yii::$app->request->referrer, -5) != "login"){
				//	return $this->goBack(Yii::$app->request->referrer);
				//}else{
				//	return $this->redirect(['account/']);
				//}
			}
		}
		
		return $this->render("login",['model'=>$model]);
	}

	public function actionCreate()
	{
		$model = new User;	
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			if($model->regByMail($post)){
				Yii::$app->session->setFlash('success','Thank you!');
				//return $this->redirect(['account/']);
			}
		 }
		return $this->render('register',['model'=>$model]);

	}

	public function actionLogout()
	{
		Yii::$app->user->logout(false);	
		//return $this->goBack(Yii::$app->request->referrer);
		return $this->redirect(['account/login']);
	}

	public function actionProfile()
	{
		$profile = Profile::find()->where('userid = :id',[':id' => Yii::$app->user->id])->one();
		$user = User::find()->where('userid = :id',[':id' => Yii::$app->user->id])->one();
		if(empty($profile)){
			$profile = new Profile;
			$profile['sex'] = 0;
			$profile['userid'] = Yii::$app->user->id;
			$profile['createtime'] = time();
			$profile['birthday'] = date("Y-m-d");
		}
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			if(!isset($post['User']['userpass'])){
				if($profile->updateProfile($post)){
					Yii::$app->session['username'] = $post['Profile']['username'];
					Yii::$app->session->setFlash('accountinfo','Your account has been successfully updated.');
				}
			}else{
				if($user->changepass($post)){
					Yii::$app->session->setFlash('accountinfo','Your password has been successfully updated.');
				}	
			}
		}
		$user->userpass = '';
		$user->repass = '';
		return $this->render('profile',['model'=> $profile,'user' => $user]);
	}
	
	public function actionForget()
	{
		$model = new User;
		if (Yii::$app->request->isPost) {
		    $post = Yii::$app->request->post();
		    if ($model->seekPass($post)) {
			Yii::$app->session->setFlash('info', 'We’ve sent you a link to reset your password.');
		    }
		}
		return $this->render("seekpassword", ['model' => $model]);
	}

	public function actionPassword()
	{
		$time = Yii::$app->request->get("timestamp");
		$useremail = Yii::$app->request->get("useremail");
		$token = Yii::$app->request->get("token");
		$model = new User();
		$myToken = $model->createToken($useremail,$time);
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			if($model->changePass($post,"forget")){
				Yii::$app->session->setFlash('accountinfo','Your account has been successfully updated.');
			}
		}else{	
			if($token != $myToken){
				$this->redirect(['account/login']);
				Yii::$app->end();
			}
			if(time() - $time >300){
				$this->redirect(['account/login']);
				Yii::$app->end();
			}
		}
		$model->useremail = $useremail;
		return $this->render("changepass",['model' => $model]);
	}	
	
	public function actionAddress()
	{
		$userid = Yii::$app->user->id;
		$address = Address::find()->where('userid = :id',[':id' => $userid])->one();
		if(!$address){
			$address = new Address();
			$address->userid = $userid;
		}
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			if($address->load($post) && $address->save($post)){
				Yii::$app->session->setFlash('addressinfo','Your address has been successfully updated');
			}
		}
		return $this->render("address",['model' => $address]);
	}

	public function actionOrder()
	{
		$orders = Order::find()->where("userid = :id",[":id" => Yii::$app->user->id])->all();
		foreach($orders as $order){
			$order->zhstatus = Order::$status[$order->status];
		}
		return $this->render("orders",['orders'=>$orders]);
	}

	public function actionOrderdetail()
	{
		$orderid = Yii::$app->request->get("orderid");
		$order = Order::find()->where("orderid = :id",[":id" => $orderid])->one();
		$address = Address::find()->where("addressid = :id",[":id" => $order->addressid])->one();
		$orderDetail = OrderDetail::find()->where("orderid = :id",[":id" => $orderid])->all();
		return $this->render("orderDetail",['order' => $order,'orderdetail' => $orderDetail,'address' => $address]);
	}
}
