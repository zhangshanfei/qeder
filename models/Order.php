<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\OrderDetail;
use app\models\Address;
use app\models\Product;
use app\models\Category;

class Order extends ActiveRecord
{
    const CHECKORDER = 100;
    const PAYSUCCESS = 202;
    const SENDED = 220;
    const CANCELED = 260; 

    public static $status = [
        self::CHECKORDER  => 'pending',
        self::PAYSUCCESS  => 'processing',
        self::SENDED      => 'completed',
        self::CANCELED    => 'canceled',
    ];

    public $products;
    public $zhstatus;
    public $username;
    public $address;

    public function rules()
    {
        return [
            [['userid', 'status'], 'required', 'on' => ['add']],
            [['addressid', 'expressid', 'amount', 'status'], 'required', 'on' => ['update']],
            ['expressno', 'required', 'message' => '请输入快递单号', 'on' => 'send'],
            ['createtime', 'safe', 'on' => ['add']],
        ];
    }

    public static function tableName()
    {
        return "{{%order}}";
    }

    public function attributeLabels()
    {
        return [
            'expressno' => '快递单号',
        ];
    }

    public function getDetail($orders)
    {
        foreach($orders as $order){
            $order = self::getData($order);
        }
        return $orders;
    }

    public static function getData($order)
    {
        $details = OrderDetail::find()->where('orderid = :oid', [':oid' => $order->orderid])->all();
        $products = [];
        foreach($details as $detail) {
            $product = Product::find()->where('productid = :pid', [':pid' => $detail->productid])->one();
            if (empty($product)) {
                continue;
            }
            $product->num = $detail->productnum;
            $products[] = $product;
        }
	$order->products = $products;
        $user = User::find()->where('userid = :uid', [':uid' => $order->userid])->one();
        if (!empty($user)) {
            $order->username = $user->username;
        }
        $address = Address::find()->where('addressid = :aid', [':aid' => $order->addressid])->one();
        if (empty($address)) {
            $order->address = "";
        } else {
            $order->address = $address->address1."</br>".$address->address2."</br>".$address->city." , ".$address->province." , ".$address->postalcode."</br>".\Yii::$app->params['country'][$address->country]."</br>".$address->telephone;
        }
        $order->zhstatus = self::$status[$order->status];
        return $order;
    }

    public static function getProducts($userid)
    {
        $orders = self::find()->where('userid = :uid', [':uid' => $userid])->orderBy('createtime desc')->all();
        foreach($orders as $order) {
            $details = OrderDetail::find()->where('orderid = :oid', [':oid' => $order->orderid])->all();
            $products = [];
	    $totalPrice = 0;
            foreach($details as $detail) {
                $product = Product::find()->where('productid = :pid', [':pid' => $detail->productid])->one();
                if (empty($product)) {
                    continue;
                }
                $product->num = $detail->productnum;
                $product->price = $detail->price;
                $product->cate = Category::find()->where('cateid = :cid', [':cid' => $product->cateid])->one()->title;
                $products[] = $product;
		$totalPrice = $totalPrice + $detail->productnum*$detail->price;
            }
            $order->zhstatus = self::$status[$order->status];
            $order->products = $products;
            $order->amount = $totalPrice;
        }
        return $orders;
    }


}

