<?php

use app\modules\v1\controllers\PubController;

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
    'modules' => [
        'v1' => [
            'class' => 'app\modules\v1\Module',
        ],
        'frontend' => [
            'class' => 'app\modules\frontend\Module',
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'gFiR6m-OqCvb0SH93GnBVvK6dl2GpAXq',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'enableCsrfValidation' => false,
        ],
        'response' => [
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
            'format' => \yii\web\Response::FORMAT_JSON,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => app\models\User::class,
            'enableSession' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '/api/v1/docs' => 'v1/default/doc',
                '/api/v1/api' => 'v1/default/api',
                [
                    'class' => yii\rest\UrlRule::class,
                    'controller' => ['v1/client', 'v1/pub'],
                    'prefix' => 'api',
                    'extraPatterns' => [
                        'OPTIONS <action:\w+>' => 'options',
                        'GET fetch-pub-state/pub/<pub_id:\d+>' => 'fetch-pub-state',
                        'OPTIONS fetch-pub-state/pub/<pub_id:\d+>' => 'options',
                        'GET order-pub-music/pub/<pub_id:\d+>/music/<music_id:\d+>' => 'order-pub-music',
                        'OPTIONS order-pub-music/pub/<pub_id:\d+>/music/<music_id:\d+>' => 'options',
                    ]
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
