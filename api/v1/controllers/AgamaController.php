<?php
namespace api\v1\controllers;

use Yii;
use api\modules\MyActiveController;
use common\models\AgamaSearch;

class AgamaController extends MyActiveController {
    public $modelClass = Agama::class;

    public function actionIndex(){

        // $query = Agama::find();
        $dataProvider = (new AgamaSearch())->search(Yii::$app->request->queryParams);
        return $dataProvider;
    }
}