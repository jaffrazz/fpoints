<?php

namespace backend\controllers;

use Yii;
use common\models\Pegawai;
use common\models\PegawaiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PegawaiController implements the CRUD actions for Pegawai model.
 */
class PegawaiController extends Controller
{
    public $status_kepegawaian = [
        'Pegawai Tetap' => 'Pegawai Tetap', 
        'Pegawai Tidak Tetap' => 'Pegawai Tidak Tetap', 
        'Magang' => 'Magang'
    ];

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
     * Lists all Pegawai models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status_kepegawaian' => $this->status_kepegawaian,
        ]);
    }

    /**
     * Displays a single Pegawai model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerUser = new \yii\data\ArrayDataProvider([
            'allModels' => $model->users,
        ]);
        $providerWaliKelas = new \yii\data\ArrayDataProvider([
            'allModels' => $model->waliKelas,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerUser' => $providerUser,
            'providerWaliKelas' => $providerWaliKelas,
        ]);
    }

    /**
     * Creates a new Pegawai model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pegawai();
        $agama = $this->getDropdownAgama();
        $jabatan = $this->getDropdownJabatan();

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Pegawai berhasil ditambahkan.");
            return $this->redirect(['view', 'id' => $model->id_pegawai]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'agama' => $agama,
                'jabatan' => $jabatan,
                'status_kepegawaian' => $this->status_kepegawaian,
            ]);
        }
    }

    /**
     * Updates an existing Pegawai model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $agama = $this->getDropdownAgama();
        $jabatan = $this->getDropdownJabatan();

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Pegawai berhasil diubah.");
            return $this->redirect(['view', 'id' => $model->id_pegawai]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'agama' => $agama,
                'jabatan' => $jabatan,
                'status_kepegawaian' => $this->status_kepegawaian,
            ]);
        }
    }

    /**
     * Deletes an existing Pegawai model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $trans = Yii::$app->db->beginTransaction();
        try {
            $this->findModel($id)->deleteWithRelated();
            $trans->commit();
            Yii::$app->session->setFlash('success', "Pegawai berhasil dihapus.");
        } catch (\Exception $e) {
            $trans->rollBack();
            Yii::$app->session->setFlash('error', 'Error, cant perform this action correctly.');
        }

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the Pegawai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pegawai the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pegawai::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function getDropdownAgama(){
        return \yii\helpers\ArrayHelper::map(
            \common\models\Agama::find()->orderBy('id_agama')->asArray()->all(), 
            'id_agama', 
            'agama');
    }
    public function getDropdownJabatan(){
        return \yii\helpers\ArrayHelper::map(
            \common\models\Jabatan::find()->orderBy('id_jabatan')->asArray()->all(), 
            'id_jabatan', 
            'jabatan');
    }
}
