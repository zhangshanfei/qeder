<?php
namespace app\modules\controllers;

use app\models\Order;
use app\models\OrderDetail;
use app\models\Address;
use app\modules\controllers\BaseController;
use yii\data\Pagination;
use Yii;

class OrderController extends BaseController
{
	public function actionList()
	{
		$model = Order::find();
		$count = $model->count();
		$pageSize = Yii::$app->params['pageSize']['order'];
		$pager = new Pagination(['totalCount' => $count,'pageSize' => $pageSize]);
		$data = $model->offset($pager->offset)->limit($pager->limit)->all();
		$data = Order::getDetail($data);
		return $this->render("list",['pager' => $pager,'orders' => $data]);
	}
}
