<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Address extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%address}}";
    }

    public function rules()
    {
        return [
            [['firstname', 'lastname', 'address1','city','country', 'province','postalcode'], 'required'],
            [['createtime', 'postcode','telephone','address2'],'safe'],
        ];
    }
}

