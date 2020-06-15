<?php

namespace backend\controllers;

use Yii;
use common\models\Penghargaan;
use common\models\PenghargaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PenghargaanController implements the CRUD actions for Penghargaan model.
 */
class PenghargaanController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'get-pasal'],
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
     * Lists all Penghargaan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenghargaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Penghargaan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerPrestasi = new \yii\data\ArrayDataProvider([
            'allModels' => $model->prestasis,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerPrestasi' => $providerPrestasi,
        ]);
    }

    /**
     * Creates a new Penghargaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Penghargaan();

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Penghargaan berhasil ditambahkan.");

            return $this->redirect(['view', 'id' => $model->id_penghargaan]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Penghargaan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Penghargaan berhasil diubah.");

            return $this->redirect(['view', 'id' => $model->id_penghargaan]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Penghargaan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $trans = Yii::$app->db->beginTransaction();
        try {
            $this->findModel($id)->delete();

            $trans->commit();
            Yii::$app->session->setFlash('success', "Penghargaan berhasil dihapus.");
        } catch (\Exception $e) {
            $trans->rollBack();
            Yii::$app->session->setFlash('error', 'Error, cant perform this action correctly.');
        }

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the Penghargaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Penghargaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Penghargaan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    

    public function actionGetPasal($id){
        $number = Penghargaan::find()->Where(['id_kategori_penghargaan' => $id])->max("regexp_replace(pasal,'[A-Za-z]','')");
        
        if($id < 26){
            $char = chr(64+$id);
        }else{
            $count = floor($id / 26);
            $mod = $id % 26;
            $char = '';
            if($count < 26){
                $char .= chr(64+$count) . chr(64+$mod);
            }
        }

        $number += 1;
        $pasal = $char.$number;
        
        return json_encode(['pasal' => $pasal]);
    }
    
}
