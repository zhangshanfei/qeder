<?php

namespace app\models;

use yii\db\ActiveRecord;

class Profile extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%profile}}";
    }
 
    public function rules()
    {
	return [
		['username','unique'],
		[['createtime','sex','birthday'],'safe'],
	];
    }

    public function updateProfile($data)
    {
	if($this->load($data) && $this->validate()){
		return $this->save();
	}	
	return false;
    }
}

