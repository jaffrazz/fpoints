<?php

namespace backend\controllers;

use Yii;
use common\models\Siswa;
use common\models\SiswaSearch;
use common\models\OnKelasSiswa;
use backend\helpers\File;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SiswaController implements the CRUD actions for Siswa model.
 */
class SiswaController extends Controller
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
     * Lists all Siswa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SiswaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Siswa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerDetailAbsensi = new \yii\data\ArrayDataProvider([
            'allModels' => $model->detailAbsensis,
            'sort' => [
                'attributes' => ['absensi.tanggal_efektif']
            ]
        ]);
        $providerDetailAkumulasiPoint = new \yii\data\ArrayDataProvider([
            'allModels' => $model->detailAkumulasiPoints,
        ]);
        $providerPelanggaran = new \yii\data\ArrayDataProvider([
            'allModels' => $model->pelanggarans,
            'sort' => [
                'attributes' => ['tanggal']
            ]
        ]);
        $providerPrestasi = new \yii\data\ArrayDataProvider([
            'allModels' => $model->prestasis,
            'sort' => [
                'attributes' => ['tanggal']
            ]
        ]);
        $providerSp = new \yii\data\ArrayDataProvider([
            'allModels' => $model->sps,
            'sort' => [
                'attributes' => ['tanggal']
            ]
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerDetailAbsensi' => $providerDetailAbsensi,
            'providerDetailAkumulasiPoint' => $providerDetailAkumulasiPoint,
            'providerPelanggaran' => $providerPelanggaran,
            'providerPrestasi' => $providerPrestasi,
            'providerSp' => $providerSp,
        ]);
    }

    /**
     * Creates a new Siswa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Siswa();
        $modelOnKelas = new OnKelasSiswa();

        if ($model->loadAll(Yii::$app->request->post())) {            
            $trans = Yii::$app->db->beginTransaction();
            
            try {
                $suffix = 'Siswa_' . $model->id_siswa;
                // handling error 
                // save with saveAs
                $model->save();

                $check = File::Upload($model, 'photo', 'foto_siswa', $suffix);

                if (isset($check['failed'])) {
                    $errors = implode('<br>', $check['failed']);

                    $trans->rollBack();
                    Yii::$app->session->setFlash('error', $errors);
                    
                    return $this->render('create', [
                        'model' => $model,
                        'modelOnKelas' => $modelOnKelas,
                    ]);
                }

                $modelOnKelas->loadAll(Yii::$app->request->post());
                $modelOnKelas->id_siswa = $model->id_siswa;
                $modelOnKelas->save();

                
                $trans->commit();
                Yii::$app->session->setFlash('success', "Siswa berhasil ditambahkan.");

                return $this->redirect(['view', 'id' => $model->id_siswa]);
            } catch (\Exception $e) {
                $trans->rollBack();

                Yii::$app->session->setFlash('error', "Error, cant perform this action correctly.");
                
                return $this->render('create', [
                    'model' => $model,
                    'modelOnKelas' => $modelOnKelas,
                ]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
                'modelOnKelas' => $modelOnKelas,
            ]);
        }
    }

    /**
     * Updates an existing Siswa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelOnKelas = OnKelasSiswa::find()->where(['id_siswa' => $id])->one();

        if ($model->loadAll(Yii::$app->request->post())) {      
            $trans = Yii::$app->db->beginTransaction();

            try {
                $suffix = 'Siswa_' . $model->id_siswa;

                $check = File::Upload($model, 'photo', 'foto_siswa', $suffix);

                if (isset($check['failed'])) {
                    $errors = implode('<br>', $check['failed']);

                    $trans->rollBack();
                    Yii::$app->session->setFlash('error', $errors);
                    return $this->redirect(['index']);
                }

                $modelOnKelas->loadAll(Yii::$app->request->post());
                $modelOnKelas->id_siswa = $model->id_siswa;
                $model->save();
                $modelOnKelas->save();

                $trans->commit();
                Yii::$app->session->setFlash('success', "Siswa berhasil diubah.");

                return $this->redirect(['view', 'id' => $model->id_siswa]);
            } catch (\Exception $e) {
                $trans->rollBack();

                Yii::$app->session->setFlash('error', "Error, cant perform this action correctly : $e");
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelOnKelas' => $modelOnKelas,
            ]);
        }
    }

    /**
     * Deletes an existing Siswa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $trans = Yii::$app->db->beginTransaction();
        try {
            $model = $this->findModel($id);
            $modelOnKelas = $model->onKelasSiswa;
            $path = \yii\helpers\Url::to('@webroot/uploaded/profile/'. $model->foto_siswa);
            $modelOnKelas->delete();
            $model->deleteWithRelated();

            if($path != ""){
                if( file_exists($path) ) unlink($path);
            }
            
            $trans->commit();
            Yii::$app->session->setFlash('success', "Siswa berhasil dihapus.");
        } catch (\Exception $e) {
            $trans->rollBack();
            Yii::$app->session->setFlash('error', "Error, cant perform this action correctly.:$e");
        }

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the Siswa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Siswa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Siswa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
