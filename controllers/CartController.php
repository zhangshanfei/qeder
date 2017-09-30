<?php
namespace app\controllers;
use app\controllers\BaseController;
use app\models\User;
use app\models\Cart;
use app\models\Address;
use app\models\Product;
use Yii;

class CartController extends BaseController
{
	protected $except = ['index','add','del','mod'];
	public function actionIndex()
	{
		Yii::$app->session['step'] = 'index';
		$cart = Cart::find()->where(['or', 'sessionid = "' . Yii::$app->session->id . '"', 'userid = ' . (Yii::$app->user->id ? Yii::$app->user->id : -1)])->asArray()->all();
		$data = [];
		$cartnum = 0;
		foreach($cart as $k=>$pro){
			$product = Product::find()->where('productid = :pid',[':pid' => $pro['productid']])->one();
			$data[$k]['cover'] = $product->cover;
			$data[$k]['title'] = $product->title;
			$data[$k]['productnum'] = $pro['productnum'];
			$data[$k]['price'] = $pro['price'];
			$data[$k]['productid'] = $pro['productid'];
			$data[$k]['cartid'] = $pro['cartid'];
			$cartnum = $cartnum + $pro['productnum'];
		}
		Yii::$app->session['cartnum'] = $cartnum;
		return $this->render("index",['data' => $data]);
	}

	public function actionAdd()
	{
		if(Yii::$app->request->isGet){
			Yii::$app->session['step'] = 'add';
			$cart = Cart::find()->where(['or', 'sessionid = "' . Yii::$app->session->id . '"', 'userid = ' . (Yii::$app->user->id ? Yii::$app->user->id : -1)])->asArray()->all();
			$productid = Yii::$app->request->get("productid");
			if(!isset($productid)){
				return $this->redirect(['cart/']);
			}
			$productnum = Yii::$app->request->get("productnum") != 0 ? Yii::$app->request->get("productnum") : 1;
			$product = Product::find()->where('productid = :pid',[':pid' => $productid])->one();
			$price = $product->price;
			$data['Cart'] = ['productid' => $productid,'productnum' => $productnum,'price' => $price,'productname' => $product->title,'productcover' => $product->cover];
			if($model = Cart::find()->where(['and', 'productid=' . $data['Cart']['productid'], ['or', 'sessionid="' . Yii::$app->session->id . '"', 'userid=' . Yii::$app->user->isGuest ? 0 : Yii::$app->user->id]])->one()){
				$data['Cart']['productnum'] = $model->productnum + $productnum;
			}else{
				$model = new Cart;
				$data['Cart']['userid'] = Yii::$app->user->isGuest ? 0 : Yii::$app->user->id;	
				$data['Cart']['sessionid'] = Yii::$app->session->id;	
				$data['Cart']['createtime'] = time();
			}
			$model->load($data);
			$model->save();
		}
		//if(!$model = Cart::find()->where('productid = :pid and userid = :uid',[':pid'=>$data['Cart']['productid'],':uid'=>$data['Cart']['userid']])->one()){
		//	$model = new Cart;
		//}else{
		//	$data['Cart']['productnum'] = $model->productnum + $productnum;
		//}
		//$data['Cart']['createtime'] = time();
		//$model->load($data);
		//$model->save();
		//return $this->redirect(['cart/index']);
	}

	public function actionMod()
	{
		$cartid = Yii::$app->request->get("cartid");
		$productnum = Yii::$app->request->get("productnum");
		Cart::updateAll(['productnum' => $productnum],'cartid = :cid',[':cid' => $cartid]);
	}

	public function actionDel()
	{
		$cartid = Yii::$app->request->get("cartid");
		Cart::deleteAll('cartid= :cid',[':cid'=>$cartid]);
		return $this->redirect(['cart/']);
	}

	public function actionProcess()
	{
		$userid = Yii::$app->user->id;
		$address = Address::find()->where('userid = :id',[':id'=>$userid])->one();
		if(!$address){
			$address = new Address();
		}
		$cart = Cart::find()->where('userid = :id ',[':id' => $userid])->all();
		if(!$cart){
			return $this->redirect(['cart/']);
		}
		$data = [];
		foreach($cart as $k=>$pro){
			$product = Product::find()->where('productid = :pid',[':pid' => $pro['productid']])->one();
			$data[$k]['cover'] = $product->cover;
			$data[$k]['title'] = $product->title;
			$data[$k]['productnum'] = $pro['productnum'];
			$data[$k]['price'] = $pro['price'];
			$data[$k]['productid'] = $pro['productid'];
			$data[$k]['cartid'] = $pro['cartid'];
		}
		return $this->render("process",['model' => $address,'data' => $data]);
	}

	public function actionAddress()
	{
		$userid = Yii::$app->user->id;
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->post();
			$model = Address::find()->where('userid = :id',[':id' => $userid])->one();
			if(!$model){
				$model = new Address();
				$model->userid = $userid;
			}
			if($model->load($post) && $model->save($post)){
				Yii::$app->session->setFlash('address_success_info','Your address has been successfully updated');
			}
		}
		return $this->redirect(['cart/process']);
		//return $this->render("index",['orders'=>$orders,'model'=>$model]);
	}

}
