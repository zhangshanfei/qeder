<?php
namespace app\modules\controllers;

use yii\web\Controller;
use Yii;
use app\modules\models\Admin;
use yii\data\Pagination;
use app\modules\controllers\BaseController;

class ManageController extends BaseController
{
	public function actionManagers()
	{
		$model = Admin::find();
		$count = $model->count();
		$pageSize = Yii::$app->params['pageSize']['manage'];
		$pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
		$managers = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render("managers", ['managers' => $managers, 'pager' => $pager]);
	} 

	public function actionReg()
        {
		$model = new Admin;
		if (Yii::$app->request->isPost) {
		    $post = Yii::$app->request->post();
		    if ($model->reg($post)) {
			Yii::$app->session->setFlash('info', '添加成功');
		    } else {
			Yii::$app->session->setFlash('info', '添加失败');
		    }
		}
		$model->adminpass = '';
		$model->repass = '';
		return $this->render('reg', ['model' => $model]);
        }	
}
