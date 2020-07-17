<?php
namespace api\modules;

use yii\rest\ActiveController;

class MyActiveController extends ActiveController
{
    public $modelClass = User::class;

    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JWTHttpBearer::class,
        ];

        return $behaviors;

    }

    public function actions()
    {
        $action = parent::actions();
        unset($action['index']);
        unset($action['create']);
        unset($action['update']);
        unset($action['delete']);
    }
}