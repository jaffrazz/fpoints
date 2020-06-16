<?php

namespace backend\controllers;

use Yii;
use common\models\TanggalEfektif;
use common\models\TanggalEfektifSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TanggalEfektifController implements the CRUD actions for TanggalEfektif model.
 */
class TanggalEfektifController extends Controller
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
     * Lists all TanggalEfektif models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TanggalEfektifSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TanggalEfektif model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerAbsensi = new \yii\data\ArrayDataProvider([
            'allModels' => $model->absensis,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerAbsensi' => $providerAbsensi,
        ]);
    }

    /**
     * Creates a new TanggalEfektif model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TanggalEfektif();

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','Tanggal Efektif berhasil ditambahkan');
            return $this->redirect(['view', 'id' => $model->id_tanggal_efektif]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TanggalEfektif model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Tanggal Efektif berhasil diubah');

            return $this->redirect(['view', 'id' => $model->id_tanggal_efektif]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TanggalEfektif model.
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
            
            Yii::$app->session->setFlash('error','Error, cant perform this action correctly');
        }catch(\Exception $e){
            $trans->rollBack();
            Yii::$app->session->setFlash('error','Error, cant perform this action correctly');
        }

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the TanggalEfektif model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TanggalEfektif the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TanggalEfektif::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
