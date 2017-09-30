<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Product extends ActiveRecord
{
    const AK = 'ihs0DYPj9cb4sMo0x2iEK87BzFP8e71nnnFcmrQM';
    const SK = '57iGkIarrzqPqbGmlaZqOEqwjgdjchKmmP75FP8f';
    const DOMAIN = 'images.qedertek.com';
    const BUCKET = 'qedertekbucket';
    public $cate;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createtime',
                'updatedAtAttribute' => 'updatetime',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['createtime', 'updatetime'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updatetime'],
                ]
            ]
        ];
    }

    public function rules()
    {
        return [
            ['title', 'required', 'message' => '标题不能为空'],
            ['descr', 'required', 'message' => '描述不能为空'],
            ['cateid', 'required', 'message' => '分类不能为空'],
            [['price','saleprice'], 'number', 'min' => 0, 'message' => '价格必须是数字'],
            ['num', 'integer', 'min' => 0, 'message' => '库存必须是数字'],
            [['price','saleprice','num','discount'], 'default', 'value' => 0],
            [['meta_title','meta_keywords','meta_descr','cover','issale','ishot', 'pics', 'isrec','short_descr','faq','amazon_url','walmart_url','promotion_code','discount'],'safe'],
            [['issale','ishot', 'pics', 'isrec','ison'],'default','value'=>0],
        ];
    }

    public function attributeLabels()
    {
        return [
            'cateid' => '分类名称',
            'title'  => '商品名称',
            'descr'  => '商品详情',
            'short_descr'  => '商品短述',
            'price'  => '商品价格',
            'ishot'  => '是否热卖',
            'issale' => '是否促销',
            'saleprice' => '促销价格',
            'num'    => '库存',
            'cover'  => '图片封面',
            'pics'   => '商品图片',
            'ison'   => '是否上架',
            'isrec'   => '是否推荐',
            'promotion_code'   => '促销代码',
            'discount'   => '折扣力度',
        ];
    }

    public static function tableName()
    {
        return "{{%product}}";
    }

    public function add($data)
    {
        if ($this->load($data) && $this->save()) {
            return true;
        }
        return false;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['cateid' => 'cateid']);
    }



}

