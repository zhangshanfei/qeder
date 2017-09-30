<?php
namespace app\models;
use yii\db\ActiveRecord;

class Community extends ActiveRecord
{
	public $verifyCode;
	public static function tableName()
	{
		return "{{%community}}";
	}
	
	public function rules()
	{
		return [
			[['firstname','lastname','email','profile_link','verifyCode'],'required'],
			['email','email'],
			['verifyCode','captcha']
		];
	}
	
	public function add($data)
	{
	    if ($this->load($data) && $this->save()) {
		return true;
	    }
	    return false;
	}

}
