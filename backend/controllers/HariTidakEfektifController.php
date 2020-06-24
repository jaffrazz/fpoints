<?php

namespace backend\controllers;

use Yii;
use common\models\HariTidakEfektif;
use common\models\HariTidakEfektifSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HariTidakEfektifController implements the CRUD actions for HariTidakEfektif model.
 */
class HariTidakEfektifController extends Controller
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
     * Lists all HariTidakEfektif models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HariTidakEfektifSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HariTidakEfektif model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HariTidakEfektif model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HariTidakEfektif();

        if ($model->loadAll(Yii::$app->request->post())) {

            if( $this->checkDate($model->tanggal_awal, $model->tanggal_akhir) ){
                if( $this->validDate($model) ){
                    $model->save();
                    Yii::$app->session->setFlash('success', "Hari tidak efektif berhasil ditambahkan.");
                    return $this->redirect(['view', 'id' => $model->id_hari_tidak_efektif]);
                }else{
                    Yii::$app->session->setFlash('error', "Tanggal akhir tidak boleh lebih kecil dari tanggal awal.");
                }
            }else{
                Yii::$app->session->setFlash('error', 'Tanggal yang anda input telah tersedia, didata lain.');
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HariTidakEfektif model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post())) {
            
            if( $this->validDate($model) ){
                $model->save();
                Yii::$app->session->setFlash('success', "Hari tidak efektif berhasil diubah.");
                return $this->redirect(['view', 'id' => $model->id_hari_tidak_efektif]);
            }else{
                Yii::$app->session->setFlash('error', "Tanggal akhir tidak boleh lebih kecil dari tanggal awal.");

                return $this->render('update', [
                    'model' => $model,
                ]);
            }
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HariTidakEfektif model.
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
            Yii::$app->session->setFlash('success', "Hari tidak efektif berhasil dihapus.");
        } catch (\Exception $e) {
            $trans->rollBack();
            Yii::$app->session->setFlash('error', 'Error, cant perform this action correctly.');
        }

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the HariTidakEfektif model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HariTidakEfektif the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HariTidakEfektif::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * check if tanggal_awal less than 
     * tanggal akhir
     * 
     * @param $model
     * @return boolean
     */
    protected function validDate($model){
        if($model->tanggal_akhir == null){
            return true;
        }

        if(strtotime($model->tanggal_awal) < strtotime($model->tanggal_akhir) ){
            return true;
        }

        return  false;

    }

    /**
     * Check if date exist
     * in database or not
     * 
     * @param $start_date
     * @param $end_date
     * @return boolean
     */
    protected function checkDate($start_date, $end_date = null){
        $checkStartDate = HariTidakEfektif::find()
            ->where([
                'Or',
                "date(tanggal_awal) = '$start_date' And tanggal_akhir IS null",
                [
                    'And',
                    "date(tanggal_awal) <= '$start_date'",
                    "date(tanggal_akhir) >= '$start_date'"
                ]
            ])->one();
        if( $end_date != null ){
            $checkEndDate = HariTidakEfektif::find()
                ->where([
                    'Or',
                    "date(tanggal_awal) = '$end_date' And tanggal_akhir IS null",
                    [
                        'And',
                        "date(tanggal_awal) <= '$end_date'",
                        "date(tanggal_akhir) >= '$end_date'"
                    ]
                ])->one();
        }

        if ( is_null($checkStartDate)){
            if( isset($checkEndDate) ){
                if (is_null($checkEndDate)) return true;
                else false;
            } else {
                return true;
            }
        } 
        return false;
    }
}
