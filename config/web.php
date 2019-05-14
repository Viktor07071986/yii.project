<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'defaultRoute' => 'yiirabbit/form/index',
    'modules' => [
        'yiirabbit' => [
            'class' => 'app\modules\yiirabbit\Module',
            //'defaultRoute' => 'form/index',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'PiyzRqJxl1abJEPEH0RpC08oJM_eKiUF',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'all_posts' => 'yiirabbit/form/all',
                //'delete/<id:\d+>' => 'yiirabbit/form/delete',
                //'update/<id:\d+>' => 'yiirabbit/form/update',
                //'view/<id:\d+>' => 'yiirabbit/form/view',
                '<action>/<id:\d+>' => 'yiirabbit/form/<action>',
                'rabbitmq' => 'yiirabbit/rabbit/index',
                //'rabbitmq/reader' => 'yiirabbit/rabbit/reader',
                //'rabbitmq/writer' => 'yiirabbit/rabbit/writer',
                'rabbitmq/<action>' => 'yiirabbit/rabbit/<action>',

            ],
        ],

    ],
    'params' => $params,

    'params' => [
        'rabbit_queue' => 'RabbitMQQueue',
        'rabbit_exchange' => 'amq.direct',
        'rabbit_host' => 'localhost',
        'rabbit_port' => 5672,
        'rabbit_login' => 'guest',
        'rabbit_password' => 'guest'
    ],


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
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
