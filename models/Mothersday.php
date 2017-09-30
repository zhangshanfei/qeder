<?php
namespace app\models;

use yii\db\ActiveRecord;

class Mothersday extends ActiveRecord
{
	public static function tableName()
	{
		return  "{{%mothersday}}";
	}
}
