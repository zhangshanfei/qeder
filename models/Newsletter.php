<?php

namespace app\models;

use yii\db\ActiveRecord;

class Newsletter extends ActiveRecord
{
    const ENABLE_STATUS = 1;
    const DISABLE_STATUS = 0;

    public static function tableName()
    {
        return "{{%newsletter}}";
    }
 
}

