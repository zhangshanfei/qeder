<?php

namespace app\modules\models;

use yii\db\ActiveRecord; 
use Yii;

class Setting extends ActiveRecord
{
	public static function tableName()
	{
		return "{{%setting}}";
	}
}
