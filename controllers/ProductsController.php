<?php namespace app\controllers;

use app\controllers\BaseController;
use app\models\Category;
use app\models\Product;
use app\models\Easter;
use app\models\ProductSearch;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use Yii;

class ProductsController extends BaseController
{
	protected $except = ['index','detail','search'];
	public function actionIndex()
	{
		$this->layout = 'main-layout';
		$cid = Yii::$app->request->get('cateid'); 
		$cat = new Category;
		$cateinfo = '';
		$ancestors = [];
		if(!$cid){
			$cid = 0;
		}else{
			$ancestors = $cat->getAncestors($cid);
			$cateinfo = $cat::find()->where('cateid = :id',[':id' => $cid])->one();
		}
		$data = $cat->getData();
		$data = $cat->getTree($data,$cid);
		$ancestors = $cat->getAncestors($cid);
		$childs = $cat->getChild($cid);
		//var_dump($childs);exit;
		$cids[] = $cid;
		foreach($data as $cate){
			$cids[] = $cate['cateid'];
		}
		$model = Product::find()->where(['in','cateid',$cids] )->andwhere("ison = '1'")->orderBy('createtime desc');	
		$count = $model->count();	
		$pageSize = Yii::$app->params['pageSize']['frontproduct'];
       		$pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        	//$prods = Product::find()->where(['in','cateid',$cids] )->andwhere("ison = '1'")->orderBy('createtime desc')->all();
		$prods = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('products',['prods'=> $prods,'cnames' => $ancestors,'childs' => $childs,'cateinfo' => $cateinfo,'pager' => $pager]);
	}

	public function actionDetail()
	{
		$productid = Yii::$app->request->get('productid');
		$prods = Product::find()->where('productid = :proid',[':proid' => $productid])->one();
		$cateid= $prods['cateid'];
		$cat = new Category();
		$ancestors = $cat->getAncestors($cateid);
		return $this->render('detail',['prods' => $prods,'ancestors' => $ancestors]);

	}

	public function actionSearch()
	{
		$keywords = htmlspecialchars(Yii::$app->request->get("keywords"));
		$highlight = [
			"fields" => [
				"title" => new \StdClass(),
				"descr" => new \StdClass()
			]
		];
		$searchModel = ProductSearch::find()->query([
			"multi_match" => [
				"query" => $keywords,
				"fields" => ["title"]
			],
		]);
		$count = $searchModel->count();
		$pageSize = Yii::$app->params['pageSize']['frontproduct'];
       		$pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
		$res = $searchModel->highlight($highlight)->offset($pager->offset)->limit($pager->limit)->all();
		$products = [];
		foreach($res as $result){
			$product = Product::findOne($result->productid);
			$product->title = !empty($result->highlight['title'][1]) ? $result->highlight['title'][1] : $product->title;
			$products[] = $product;
		}
		return $this->render('search',['prods' => $products,'pager' => $pager,'keywords'=>$keywords]);

	}

}
