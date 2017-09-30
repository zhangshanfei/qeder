<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Cart extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%cart}}";
    }

    public function rules()
    {
        return [
            [['productid','productnum','userid','price'], 'required'],
            [['createtime','sessionid','productname','productcover'], 'safe']
        ];
    }
    public function modSession($oldSessionid)
    {
	$carts = self::find()->where(['sessionid' => $oldSessionid])->all();
        foreach ($carts as $cart) {
            $exist = self::find()->where(['userid' => Yii::$app->user->id, 'productid' => $cart->productid])->one();
            if ($exist) {
                self::updateAllCounters(['productnum' => $cart->productnum], ['userid' => Yii::$app->user->id]);
                self::deleteAll(['sessionid' => $oldSessionid, 'productid' => $cart->productid]);
            } else {
                Cart::updateAll(['sessionid' => Yii::$app->session->id, 'userid' => Yii::$app->user->id], ['sessionid' => $oldSessionid, 'productid' => $cart->productid]);
            }
        }
        self::updateAll(['sessionid' => Yii::$app->session->id], ['userid' => Yii::$app->session->id]);

    }
} 
