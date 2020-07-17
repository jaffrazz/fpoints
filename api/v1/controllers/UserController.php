<?php
namespace api\v1\controllers;

use api\modules\JWTHttpBearer;
use api\v1\models\LoginForm;
use api\v1\models\User;
use sizeg\jwt\Jwt;
use yii;
use yii\helpers\Url;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = User::class;

    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JWTHttpBearer::class,
            'optional' => [
                'login',
            ],
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

    /**
     * landing
     * @return array
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionOauth()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            
            $user = User::findByUsername($model->username);

            $jwt = Yii::$app->jwt;
            $signer = $jwt->getSigner('HS256');
            $key = $jwt->getKey();

            $token = $jwt->getBuilder()
                ->issuedBy(Url::base(true))
                ->permittedFor(Url::base(true))
                ->identifiedBy('3L3337#(0_0)', true)
                ->issuedAt( time() )
                ->expiresAt( time()  + (3600 * 2))
                ->withClaim('uid', $user->id)
                ->getToken($signer, $key);

            $user->access_token = (string) $token;
            $user->save(0);

            return [
                'access_token' => (string) $user->access_token,
            ];
        } else {
            return $model->getFirstErrors();
        }
    }
}
