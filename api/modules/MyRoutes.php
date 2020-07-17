<?php
namespace api\modules;

class MyRoutes
{
    public static function get()
    {
        $routes = [
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'user',
            ],
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => [
                    'agama' => 'agama',
                ],
                'only' => ['index', 'view'],
                'pluralize' => false,
            ],
        ];

        return $routes;
    }
}
