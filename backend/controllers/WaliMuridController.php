<?php

namespace backend\controllers;

use Yii;
use common\models\WaliMurid;
use common\models\WaliMuridSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WaliMuridController implements the CRUD actions for WaliMurid model.
 */
class WaliMuridController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
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
     * Lists all WaliMurid models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WaliMuridSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WaliMurid model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerSiswa = new \yii\data\ArrayDataProvider([
            'allModels' => $model->siswas,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerSiswa' => $providerSiswa,
        ]);
    }

    /**
     * Creates a new WaliMurid model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WaliMurid();

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success',"$model->nama_wali_murid berhasil ditambahkan.");
            return $this->redirect(['view', 'id' => $model->id_wali_murid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing WaliMurid model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success',"$model->nama_wali_murid berhasil diubah.");
            return $this->redirect(['view', 'id' => $model->id_wali_murid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing WaliMurid model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $trans = Yii::$app->db->beginTransaction();

        try{
            $this->findModel($id)->deleteWithRelated();            
            $trans->commit();
            Yii::$app->session->setFlash('success',"Data berhasil dihapus.");
        }catch(\Exception $e){
            $trans->rollBack();
            Yii::$app->session->setFlash('error',"Data gagal dihapus.");
        }

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the WaliMurid model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WaliMurid the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WaliMurid::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
