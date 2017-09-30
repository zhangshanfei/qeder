<?php
namespace app\modules\controllers;

use yii\web\Controller;

class BaseController extends Controller
{
	public $layout = 'admin-layout';
	protected $actions = ['*'];
	protected $except = [];
	protected $mustlogin = [];
	
	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'user' => 'admin',
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
}
