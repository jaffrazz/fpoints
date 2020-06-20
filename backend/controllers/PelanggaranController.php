<?php

namespace backend\controllers;

use Yii;
use common\models\Pelanggaran;
use common\models\DetailPoint;
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
        $trans = Yii::$app->db->beginTransaction();

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            $check = $this->checkDetailPoint($model, 'create');
            
            if( isset($check['failed']) ){
                $trans->rollBack();
                Yii::$app->session->setFlash('error', $check['failed'] );
                return $this->redirect(['index']);
            }

            $trans->commit();
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
        $point_update = $model->aturan->point_aturan;
        $old_id_siswa = $model->id_siswa;

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            $check = $this->checkDetailPoint($model, 'update', $point_update, $old_id_siswa);
            
            if( isset($check['failed']) ){
                $trans->rollBack();
                Yii::$app->session->setFlash('error', $check['failed'] );
                return $this->redirect(['index']);
            }

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
        $model = $this->findModel($id);
        $trans = Yii::$app->db->beginTransaction();

        try{
            $check = $this->checkDetailPoint($model, 'delete');
            
            if( isset($check['failed']) ){
                $trans->rollBack();
                Yii::$app->session->setFlash('error', $check['failed'] );
                return $this->redirect(['index']);
            }

            $model->deleteWithRelated();
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

    /**
     * checking and update 
     * detail point siswa
     * 
     * @param $model            Model Pelanggaran
     * @param $on               action declare
     * @param $point_update     require of action update
     * @return @ret             array
     */
    protected function checkDetailPoint($model, $on = 'create', $point_update = 0, $old_id_siswa = null){
        $query = DetailPoint::findOne($model->id_siswa);
        $point_model = $model->aturan->point_aturan;

        $ret = []; // return value
        $new_data = 0;// its new data
// <A></A>

        if($query != null){
            $det_model = $query;
            $point_pelanggaran = $det_model->point_pelanggaran;
            $point_penghargaan = $det_model->point_penghargaan;
        }else{
            $new_data = 1;

            $det_model = new DetailPoint();
            $det_model->id_siswa = $model->id_siswa;
            $point_pelanggaran = 0;
            $point_penghargaan = 0;
        }

        switch($on){
            case 'create':
                $det_model->point_pelanggaran = $point_pelanggaran + $point_model;
            break;
            case 'update':
                /**
                 * if not new data,
                 * dan id siswa != old_id_siswa
                 * then update 2 data with id
                 * id_siswa dan old_id_siswa
                 */
                if( ($det_model->id_siswa != $old_id_siswa) and (null != $old_id_siswa) ){
                    $model_if_update_siswa = DetailPoint::findOne($old_id_siswa);
                    $model_if_update_siswa->point_pelanggaran -= $point_update;
                    
                    if (!$model_if_update_siswa->save()) {
                        $ret['failed'] = 'Error when trying to save data, (change siswa).';
                    }
                    
                    $det_model->point_pelanggaran = $point_pelanggaran + $point_model;
                }else{
                    $det_model->point_pelanggaran = ($point_pelanggaran - $point_update) + $point_model;
                }
            break;
            case 'delete':
                if( !$new_data ){
                    $det_model->point_pelanggaran = $point_pelanggaran - $point_model;
                }
            break;
            default:
                $ret['failed'] = 'Action not found. Please check your controller.';
            break;
        }

        // set required value
        $det_model->point_penghargaan = $point_penghargaan;
        $det_model->last_update = date('Y-m-d');

        
        if( !$det_model->save() ){
            $ret['failed'] = 'Error when trying to save data.';
        }

        return $ret;

    }
}
