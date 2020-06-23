<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

use common\models\Siswa;

class V9Controller extends Controller {

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['siswa'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    public function actionSiswa() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $id_kelas = $parents[0];
                $out = self::getSiswaList($id_kelas);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    function getSiswaList($id_kelas){
        $out = [];
        $list = Siswa::find()
            ->joinWith(['onKelasSiswa'])
            ->where(['on_kelas_siswa.id_kelas' => $id_kelas])
            ->asArray()
            ->all();
        
        foreach($list as $siswa){
            $out[] = [
                'id' => $siswa['id_siswa'],
                'name' => $siswa['nama_siswa']
            ];
        }
        return $out;
    }

}