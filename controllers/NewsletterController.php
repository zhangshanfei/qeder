<?php
namespace app\controllers;

use app\controllers\BaseController;
use app\models\Newsletter;

class NewsletterController extends BaseController
{
	protected $except = ['subscribe'];
	public $enableCsrfValidation = false;
	public function actionSubscribe()	
	{
	 	if(\Yii::$app->request->isPost){
			if(!$_POST["emailAddress"]){
				exit(json_encode(array('status' => 0,'title' => 'Prompt','message' => 'Please enter the email')));		
			}
			$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
			$emailAddress = $_POST["emailAddress"];
			if(!preg_match($pattern, $emailAddress)){
				exit(json_encode(array('status' =>0,'title' => 'Prompt','message' => 'Please enter a valid email address. For example johndoe@domain.com.')));		
			}else if($this->emailCheck($emailAddress)){
				exit(json_encode(array('status' =>0,'title' => 'Prompt','message' => 'You’ve already subscribed,thanks!')));		
			}else{
				$newsletterModel = new Newsletter();
			    	$newsletterModel->email = $emailAddress;	
			    	$newsletterModel->createtime = time();	
			    	$newsletterModel->status = Newsletter::ENABLE_STATUS;	
				$newsletterModel->save();
				exit(json_encode(array('status' =>1,'title' => 'Thank You For Subscribing!','message' => 'Thank you for subscribing to our newsletter. You have been successfully added to our mailing list, keeping you up-to-date with our latest deals and news.')));		
			}	
		}
	}

	public function emailCheck($email){
		$one = Newsletter::findone(['email' => $email]);
		if($one){
			return true;
		}
		return false;
	}
}
