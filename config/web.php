<?php

use app\components\ExceptionHelper;
use yii\web\Response;
use yii\log\FileTarget;
use app\models\UserIdentity;
use app\modules\v1\Module;
use yii\rest\UrlRule;

$params = require __DIR__ . '/params.php';
//$db = require __DIR__ . '/db.php';
$mongodb = require __DIR__ . '/mongodb.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'uG8b6LrA4EsXwJIosyNgC20XdBa3Fl_6',
        ],
        'response' => [
            'class' => Response::class,
            'on beforeSend' => static function ($event) {
                $response = $event->sender;

                if ($response->isSuccessful) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'message' => 'Успешно',
                        'data' => $response->data,
                    ];
                } else {
                    $exception = $response->data;
                    $response->data = ExceptionHelper::getData($exception);
                }
            },
        ],
        'user' => [
            'identityClass' => UserIdentity::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'mongodb' => $mongodb,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => UrlRule::class, 'controller' => [
                    'v1/post',
                ]],
                '/' => 'site/index',
            ],
        ]
    ],
    'modules' => [
        'v1' => [
            'class' => Module::class,
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => \yii\debug\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => \yii\gii\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
