<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'lib/Bootstrap/css/bootstrap.css',
        //'lib/Bootstrap/css/bootstrap-datetimepicker.min.css',
	'css/font-awesome.css',
	'css/main.css',
	'css/bootstrap-social.css',
	//'css/lg_style.css',
    ];
    public $js = [
	//'js/jquery.min.js',
	'lib/layer/layer.js',
	'js/share.js',
	'lib/Bootstrap/js/bootstrap.js',
	'lib/Bootstrap/js/bootstrap-datetimepicker.min.js',
	['js/html5shiv.js', 'condition' => 'lte IE9', 'position' => \yii\web\View::POS_HEAD],
	['js/respond.min.js', 'condition' => 'lte IE9', 'position' => \yii\web\View::POS_HEAD],	
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
