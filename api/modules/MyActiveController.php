<?php
namespace api\modules;

use Yii;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use api\modules\JWTHttpBearer;

class MyActiveController extends ActiveController
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

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

    public function _notFound($id)
    {
        throw new NotFoundHttpException('No Item found with id ' . $id);
    }

    public function findModel($id)
    {
        $data = $this->modelClass::findOne($id);
        if (is_null($data)) {
            $this->_notFound($id);
        }
        return $data;
    }


    public function actionIndex() {
        $dataProvider = (new $this->modelSearchClass())->search(Yii::$app->request->queryParams);
        return $dataProvider;
    }

    public function actionView($id) {
        $data = $this->findModel($id);
        return $data;
    }

}
