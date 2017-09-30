<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'index',
    'charset' => 'utf-8',
    'components' => [
	'elasticsearch' => [
            'class' => 'yii\elasticsearch\Connection',
            'nodes' => [
                ['http_address' => '166.62.86.189:9200'],
                // configure more hosts if you have a cluster
            ],
        ],
	'authManager' => [
		'class' => 'yii\rbac\DbManager',
		'itemTable' => '{{%auth_item}}',	
		'itemChildTable' => '{{%auth_item_child}}',	
		'assignmentTable' => '{{%auth_assignment}}',	
		'ruleTable' => '{{%auth_rule}}',	
	],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'skf@kgs9&^%sksg8io*f2',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
	    'loginUrl' => ['/account/login'],
        ],
	'admin' =>[
	    'class' => 'yii\web\User',
	    'identityClass' => 'app\modules\models\Admin',
	    'idParam' => '__admin',
	    'identityCookie' => ['name' => '__admin_identity','httpOnly' => true],
	    'enableAutoLogin' => true,
	    'loginUrl' => ['/admin/public/login'],
	],
        'errorHandler' => [
            'errorAction' => 'general/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
	    'transport' => [
		'class' => 'Swift_SmtpTransport',
		'host' => 'smtp.ym.163.com',
		'username' => 'info@qedertek.com',
		'password' => 'qedertek2017',
		'port' => '465',
		'encryption' => 'ssl',
	    ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
		'product-category-<cateid:\d+>' => 'products/index',
		 'product-<productid:\d+>' => 'products/detail',
		 'promotion' => 'information/promotion',
		 'giveaway' => 'information/giveaway',
		 'sale' => 'information/sale',
		 'deals' => 'information/deals',
                'support' => 'information/support',
                'about' => 'information/about',
                'influencer' => 'information/influencer',
            ],
        ],
       
	 'authClientCollection' => [
                'class' => 'yii\authclient\Collection',
                'clients' => [
                    'facebook' => [
                        'class' => 'yii\authclient\clients\Facebook',
                        'clientId' => '173223546539587',
                        'clientSecret' => 'aa98f932a14fdbb00856c11efe96bdb5',
                    ],
		    'google' => [
			'class' => 'yii\authclient\clients\Google',
			'clientId' => '447985004899-hc5sgv96j3bovt720m2hf0apqjas9jgl.apps.googleusercontent.com',
			'clientSecret' => 'dgzVHTAvvmpF_ZJ4a2MAkUVE',
		    ],
                ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1','192.168.1.106'],
    ];
    $config['modules']['admin'] = [
	'class' => 'app\modules\admin',
    ];
}

return $config;
