<?php

namespace backend\controllers;

use Yii;
use common\models\Kelas;
use common\models\KelasSearch;
use common\models\NamaKelas;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KelasController implements the CRUD actions for Kelas model.
 */
class KelasController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'add-on-kelas-siswa'],
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
     * Lists all Kelas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KelasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kelas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerAbsensi = new \yii\data\ArrayDataProvider([
            'allModels' => $model->absensis,
        ]);
        $providerOnKelasSiswa = new \yii\data\ArrayDataProvider([
            'allModels' => $model->onKelasSiswas,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerAbsensi' => $providerAbsensi,
            'providerOnKelasSiswa' => $providerOnKelasSiswa,
        ]);
    }

    /**
     * Creates a new Kelas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kelas();

        if ( $model->loadAll( Yii::$app->request->post() ) ) {
            $trans = Yii::$app->db->beginTransaction();
            try {
                $check = Kelas::find()
                    ->AndWhere([
                        'id_jurusan' => $model->id_jurusan,
                        'grade' => $model->grade,
                        'kelas' => $model->kelas,
                        'status' => 1
                    ])
                    ->count();
                /**
                 * Check duplicate 
                 * active class
                 */
                if( $check ) {
                    Yii::$app->session->setFlash('error','Class is active, please non-active class before create new.');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
                // if( ! )
                $model->saveAll();
                $this->namaKelas($model, 'create');

                $trans->commit();
                Yii::$app->session->setFlash('success', "Kelas berhasil ditambahkan.");

                return $this->redirect(['view', 'id' => $model->id_kelas]);
            } catch (\Exception $e) {
                $trans->rollBack();
                Yii::$app->session->setFlash('error', 'Error, cant perform this action correctly.');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Kelas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post())) {
            $trans = Yii::$app->db->beginTransaction();
            try {
                $check = Kelas::find()
                    ->where(['!=','id_kelas',$model->id_kelas])
                    ->AndWhere([
                        'id_jurusan' => $model->id_jurusan,
                        'grade' => $model->grade,
                        'kelas' => $model->kelas,
                        'status' => 1
                    ])
                    ->count();
                /**
                 * Check duplicate 
                 * active class
                 */
                if( $check ){
                    Yii::$app->session->setFlash('error','Error, class same with another active class.');
                    return $this->render('update', [
                        'model' => $model,
                    ]);

                }
                $model->saveAll();
                $this->namaKelas($model, 'update');

                $trans->commit();
                Yii::$app->session->setFlash('success', "Kelas berhasil diubah.");

                return $this->redirect(['view', 'id' => $model->id_kelas]);

            } catch (\Exception $e) {
                $trans->rollBack();
                Yii::$app->session->setFlash('error', 'Error, cant perform this action correctly.');
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
     * Deletes an existing Kelas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $trans = Yii::$app->db->beginTransaction();
        try{
            $model = $this->findModel($id);
            $this->namaKelas($model, 'delete');
            $model->deleteWithRelated();
            $trans->commit();
            Yii::$app->session->setFlash('success', "Kelas berhasil dihapus.");
        }catch(\Exception $e){
            $trans->rollBack();
            Yii::$app->session->setFlash('error','Error, cant perform this action correctly');
        }

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the Kelas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kelas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kelas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
    * Action to load a tabular form grid
    * for OnKelasSiswa
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddOnKelasSiswa()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('OnKelasSiswa');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formOnKelasSiswa', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function namaKelas($model, $key = 'update')
    {
        if ($key == 'create') {
            $modelNamaKelas = new NamaKelas();
            $modelNamaKelas->id_kelas = $model->id_kelas;
        } else if($key == 'delete') {
            $modelNamaKelas = NamaKelas::findOne($model->id_kelas);
            $modelNamaKelas->delete();
            return;
        } else if($key == 'update') {
            $modelNamaKelas = NamaKelas::findOne($model->id_kelas);
        }
        $modelNamaKelas->nama_kelas = $model->grade . " " . $model->jurusan->jurusan . " " . $model->kelas;
        $modelNamaKelas->save();

    }
}
