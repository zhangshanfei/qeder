<?php
namespace app\modules\controllers;

use app\modules\controllers\BaseController;
use \yii\data\ActiveDataProvider;
use \yii\db\Query;
use Yii;

class RbacController extends BaseController
{
	public $mustlogin = ['createrole','roles'];

	public function actionCreaterole()
	{
		if(Yii::$app->request->isPost){
			$auth = Yii::$app->authManager;
			$role = $auth->createRole(null);
			$post = Yii::$app->request->post();
			if(empty($post['name']) || empty($post['description'])){
				throw new \Exception('参数错误'); 
			}
			$role->name = $post['name'];
			$role->description = $post['description'];
			$role->ruleName = empty($post['rule_name']) ? null : $post['rule_name'];
			$role->data = empty($post['data']) ? null :  $post['data'];
			if($auth->add($role)){
				Yii::$app->session->setFlash('info','添加成功');
			}
		}
		return $this->render('_createitem');
	}

	public function actionRoles()
	{
		$auth = Yii::$app->authManager;
		$data = new ActiveDataProvider([
			'query' => (new Query)->from($auth->itemTable)->where('type = 1')->orderBy('created_at desc'),
			'pagination' => ['pageSize' => 5],
		]);
		return $this->render('_items',['dataProvider' => $data]);	
	}
}
