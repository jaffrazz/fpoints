<?php

namespace backend\controllers;

use common\models\Absensi;
use common\models\AbsensiSearch;
use common\models\HariEfektif;
use common\models\HariTidakEfektif;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * AbsensiController implements the CRUD actions for Absensi model.
 */
class AbsensiController extends Controller
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
                        'actions' => ['update', 'delete'],
                        'roles' => ['Admin'],
                    ], [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'add-detail-absensi'],
                        'roles' => ['Admin', 'Petugas ABSENSI'],
                    ],
                    [
                        'allow' => false,
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Absensi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AbsensiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Absensi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerDetailAbsensi = new \yii\data\ArrayDataProvider([
            'allModels' => $model->detailAbsensis,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerDetailAbsensi' => $providerDetailAbsensi,
        ]);
    }

    /**
     * Creates a new Absensi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Absensi();
        $trans = Yii::$app->db->beginTransaction();

        if ($this->isThisHoliday()) {
        }

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            $trans->commit();
            $kelas = $model->kelas->namaKelas->nama_kelas;
            $tanggal = $model->tanggal;
            Yii::$app->session->setFlash('success', "Berhasil melakukan Absen untuk $kelas pada $tanggal");
            return $this->redirect(['view', 'id' => $model->id_absensi]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing Absensi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id_absensi]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Absensi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Absensi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Absensi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Absensi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Action to load a tabular form grid
     * for DetailAbsensi
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddDetailAbsensi()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('DetailAbsensi');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add') {
                $row[] = [];
            }

            return $this->renderAjax('_formDetailAbsensi', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Checking it is holiday,
     * or not
     *
     * @return mixed
     */
    protected function isThisHoliday()
    {
        if (Yii::$app->user->can('Admin')) {
            return true;
        }

        $days = [
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jum'at",
            "Sabtu",
        ];

        $today = date('Y-m-d');

        // this is lower case of "W" character
        // https: //www.php.net/manual/en/function.date.php
        $day = $days[date('w')];

        $checkHari = HariEfektif::find()
            ->where([
                'nama_hari_efektif' => $day,
            ])->AndWhere(['status_hari_efektif' => 1])->one();

        $checkLibur = HariTidakEfektif::find()
            ->where([
                'Or',
                "date(tanggal_awal) = '$today' And tanggal_akhir IS null",
                [
                    'And',
                    "date(tanggal_awal) <= '$today'",
                    "date(tanggal_akhir) >= '$today'"
                ]
            ])->one();

        if ($checkLibur == null && $checkHari != null) {
            return true;
        }

        throw new ForbiddenHttpException("Hari ini adalah hari libur.");
    }
}
