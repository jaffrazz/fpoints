<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\v1\controllers',
    'name' => "FPOINTS API",
    'homeUrl' => "/fpoints/api",
    'components' => [
        'jwt' => [
            'class' => \sizeg\jwt\Jwt::class,
            'key' => 'secret',
            // You have to configure ValidationData informing all claims you want to validate the token.
            'jwtValidationData' => \api\modules\JwtValidationData::class,
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'baseUrl' => "/fpoints/api",
        ],
        'user' => [
            'identityClass' => 'api\v1\models\User',
            'enableAutoLogin' => true,
            'enableSession' => false, // disabled session
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'user',
                ],
            ],
        ],
    ],
    'params' => $params,
];
