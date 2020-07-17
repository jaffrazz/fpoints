<?php
namespace api\modules;

class MyRoutes
{
    public static function get()
    {
        $MyRoutes = ['agama','hari-efektif', 'hari-tidak-efektif', 'kelas', 'status-absensi', 'kategori-aturan', 'aturan'];

        $routes = [
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'user',
            ],
        ];

        foreach($MyRoutes as $route){
            array_push($routes, [
                'class' => 'yii\rest\UrlRule',
                'controller' => [
                    $route => $route,
                ],
                'only' => ['index', 'view'],
                'pluralize' => false,
            ]);
        }


        return $routes;
    }
}
