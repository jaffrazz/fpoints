<?php

namespace backend\controllers;

use Yii;
use common\models\TahunAjaran;
use common\models\TahunAjaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TahunAjaranController implements the CRUD actions for TahunAjaran model.
 */
class TahunAjaranController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'roles' => ['Admin']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all TahunAjaran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TahunAjaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new TahunAjaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TahunAjaran();
        $tahunAjaran = $this->generateTahunAjaran();

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Tahun Ajaran berhasil ditambahkan.");

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'tahunAjaran' => $tahunAjaran,
            ]);
        }
    }

    /**
     * Updates an existing TahunAjaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tahunAjaran = $this->generateTahunAjaran();

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Tahun Ajaran berhasil diubah.");

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tahunAjaran' => $tahunAjaran,
            ]);
        }
    }

    /**
     * Deletes an existing TahunAjaran model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $trans = Yii::$app->db->beginTransaction();

        try{
            $this->findModel($id)->delete();
            $trans->commit();
            Yii::$app->session->setFlash('success', "Data berhasil dihapus.");
        }catch(\Exception $e){
            $trans->rollBack();
            Yii::$app->session->setFlash('error', "Error, cant perform this action correctly.");
        }


        return $this->redirect(['index']);
    }

    
    /**
     * Finds the TahunAjaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TahunAjaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TahunAjaran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function generateTahunAjaran(){
        $now = \Date('Y',time());
        $nowPlus3Y = (int)$now + 3;
        $arr = [];

        for($i= (int)$now - 3; $i < $nowPlus3Y; $i++){
            $val = $i . "/". ($i+1);
            $arr[$val] = $val;
        }

        return $arr;
    }
}
