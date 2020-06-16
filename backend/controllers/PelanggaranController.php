<?php

namespace backend\controllers;

use Yii;
use common\models\Pelanggaran;
use common\models\PelanggaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PelanggaranController implements the CRUD actions for Pelanggaran model.
 */
class PelanggaranController extends Controller
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
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Pelanggaran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PelanggaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pelanggaran model.
     * @param integer $id
     * @return mixed
     */
    // public function actionView($id)
    // {
    //     $model = $this->findModel($id);
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //     ]);
    // }

    /**
     * Creates a new Pelanggaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pelanggaran();

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','Pelanggaran berhasil ditambahkan.');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pelanggaran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','Pelanggaran berhasil diubah.');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pelanggaran model.
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
            Yii::$app->session->setFlash('success','Pelanggaran berhasil dihapus');
        }catch(\Exception $e){
            $trans->rollBack();
            Yii::$app->session->setFlash('error','Error, cant perform this action correctly.');
        }

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the Pelanggaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pelanggaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pelanggaran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}