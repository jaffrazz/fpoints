<?php
namespace api\v1\controllers;

use api\modules\MyActiveController;
use api\v1\models\Agama;

class AgamaController extends MyActiveController {
    public $modelClass = Agama::class;

    public function actionIndex(){
        return Agama::find()->asArray()->all();
    }
}