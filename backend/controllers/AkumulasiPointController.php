<?php

namespace backend\controllers;

use Yii;
use common\models\AkumulasiPoint;
use common\models\AkumulasiPointSearch;
use common\models\DetailAkumulasiPoint;
use common\models\DetailPoint;
use common\models\Pelanggaran;
use common\models\Sanksi;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AkumulasiPointController implements the CRUD actions for AkumulasiPoint model.
 */
class AkumulasiPointController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'add-detail-akumulasi-point'],
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
     * Lists all AkumulasiPoint models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AkumulasiPointSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AkumulasiPoint model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerDetailAkumulasiPoint = new \yii\data\ArrayDataProvider([
            'allModels' => $model->detailAkumulasiPoints,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerDetailAkumulasiPoint' => $providerDetailAkumulasiPoint,
        ]);
    }

    /**
     * Creates a new AkumulasiPoint model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AkumulasiPoint();
        $trans = Yii::$app->db->beginTransaction();
        if ($model->loadAll(Yii::$app->request->post())) {
            try{
                $model->save();
                $detail_point = $this->getDetailAkumulasiPoint($model);
                
                foreach($detail_point as $detail){
                    // drop null query
                    $point_pelanggaran = $detail['point_pelanggaran'] == null ? 0 : $detail['point_pelanggaran'] ;
                    $point_penghargaan = $detail['point_prestasi'] == null ? 0 : $detail['point_prestasi'] ;
                    
                    // find sanksi
                    $cnt_point = $point_pelanggaran - $point_penghargaan;
                    $point = ( $cnt_point <= 0) ? 0 : $cnt_point;
                    $sanksi = Sanksi::find()
                        ->where(['<=','minimum_point', $point])
                        ->orderBy(['minimum_point' => SORT_DESC])
                        ->one();

                    // Insert data
                    $detail_model = new DetailAkumulasiPoint();
                    $detail_model->id_akumulasi_point = $model->id_akumulasi_point;
                    $detail_model->id_siswa = $detail['id_siswa'];
                    $detail_model->point_pelanggaran = $point_pelanggaran;
                    $detail_model->point_penghargaan = $point_penghargaan;
                    $detail_model->id_sanksi = $sanksi->id_sanksi;
                    $detail_model->save();

                    // reset point
                    $detailPointSiswa = DetailPoint::findOne($detail['id_siswa']);
                    $detailPointSiswa->point_pelanggaran = 0;
                    $detailPointSiswa->point_penghargaan = 0;
                    $detailPointSiswa->last_update = date('Y-m-d');
                    $detailPointSiswa->save();
                }

                // drop list prestasi & pelanggaran
                $this->dropPelanggaranAndPrestasi($model);

                $trans->commit();
                Yii::$app->session->setFlash('success', 'Point Berhasil diakumulasikan.');
                return $this->redirect(['view', 'id' => $model->id_akumulasi_point]);
            }catch(\Exception $e){
                $trans->rollBack();
                Yii::$app->session->setFlash('error', "Point gagal diakumulasikan. $e");
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
     * Updates an existing AkumulasiPoint model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id_akumulasi_point]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AkumulasiPoint model.
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
     * Finds the AkumulasiPoint model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AkumulasiPoint the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AkumulasiPoint::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for DetailAkumulasiPoint
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddDetailAkumulasiPoint()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('DetailAkumulasiPoint');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formDetailAkumulasiPoint', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Moving Data From Detail Point
     * to Detail Akumulasi Point
     * 
     * @param $model
     * @return $result
     */
    function getDetailAkumulasiPoint($model){
        /**
         * references : https://stackoverflow.com/a/30094768
         * 
         * SELECT * from (
         *     select 
         *         siswa.id_siswa ,
         *         sum(point_aturan) as point_pelanggaran,
         *         sum(point_penghargaan) as point_prestasi
         *     from (
         *         SELECT id_siswa FROM `prestasi` UNION SELECT id_siswa FROM pelanggaran
         *     ) as siswa
         *     LEFT OUTER JOIN (
         *         SELECT * FROM pelanggaran
         *         WHERE
         *             ( MONTH(tanggal) >= 6 AND YEAR( tanggal ) = YEAR( NOW() ) ) 
         *             AND ( MONTH(tanggal) <= 12 AND YEAR( tanggal ) = YEAR( NOW() ) )
         *     ) as pelanggaran
         *         INNER join aturan on aturan.id_aturan = pelanggaran.id_aturan
         *         ON pelanggaran.id_siswa = siswa.id_siswa
         *     LEFT OUTER join (
         *         SELECT * FROM prestasi
         *         WHERE
         *             ( MONTH(tanggal) >= 6 AND YEAR( tanggal ) = YEAR( NOW() ) ) 
         *             AND ( MONTH(tanggal) <= 12 AND YEAR( tanggal ) = YEAR( NOW() ) )
         *     ) as prestasi 
         *         INNER join penghargaan on penghargaan.id_penghargaan = prestasi.id_penghargaan
         *         ON prestasi.id_siswa = siswa.id_siswa
         *     GROUP BY siswa.id_siswa
         * ) as i
         * 
         */

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT * from (
                select 
                    siswa.id_siswa ,
                    sum(point_aturan) as point_pelanggaran,
                    sum(point_penghargaan) as point_prestasi
                from (
                    SELECT id_siswa FROM `prestasi` UNION SELECT id_siswa FROM pelanggaran
                ) as siswa
                LEFT OUTER JOIN (
                    SELECT * FROM pelanggaran
                    WHERE
                        ( MONTH(tanggal) >= :bulan_awal AND YEAR( tanggal ) = :tahun ) 
                        AND ( MONTH(tanggal) <= :bulan_akhir AND YEAR( tanggal ) = :tahun )
                ) as pelanggaran
                    INNER join aturan on aturan.id_aturan = pelanggaran.id_aturan
                    ON pelanggaran.id_siswa = siswa.id_siswa
                LEFT OUTER join (
                    SELECT * FROM prestasi
                    WHERE
                        ( MONTH(tanggal) >= :bulan_awal AND YEAR( tanggal ) = :tahun ) 
                        AND ( MONTH(tanggal) <= :bulan_akhir AND YEAR( tanggal ) = :tahun )
                ) as prestasi 
                    INNER join penghargaan on penghargaan.id_penghargaan = prestasi.id_penghargaan
                    ON prestasi.id_siswa = siswa.id_siswa
                GROUP BY siswa.id_siswa
            ) as i", [
                ':bulan_awal' => $model->semester->awal_bulan_semester,
                ':bulan_akhir' => $model->semester->akhir_bulan_semester,
                ':tahun' => explode('/',$model->tahunAjaran->tahun_ajaran)[0],
            ]);

        $result = $command->queryAll();

        return $result;
    }

    protected function dropPelanggaranAndPrestasi($model){
        $pelanggaran = "DELETE FROM pelanggaran WHERE
                        ( MONTH(tanggal) >= :bulan_awal AND YEAR( tanggal ) = :tahun ) 
                        AND ( MONTH(tanggal) <= :bulan_akhir AND YEAR( tanggal ) = :tahun )";
        $prestasi = "DELETE FROM prestasi WHERE
                        ( MONTH(tanggal) >= :bulan_awal AND YEAR( tanggal ) = :tahun ) 
                        AND ( MONTH(tanggal) <= :bulan_akhir AND YEAR( tanggal ) = :tahun )";
        $connection = Yii::$app->getDb();

        $cmd1 = $connection->createCommand($pelanggaran,[
            ':bulan_awal' => $model->semester->awal_bulan_semester,
            ':bulan_akhir' => $model->semester->akhir_bulan_semester,
            ':tahun' => explode('/',$model->tahunAjaran->tahun_ajaran)[0],
        ]);

        $cmd2 = $connection->createCommand($prestasi,[
            ':bulan_awal' => $model->semester->awal_bulan_semester,
            ':bulan_akhir' => $model->semester->akhir_bulan_semester,
            ':tahun' => explode('/',$model->tahunAjaran->tahun_ajaran)[0],
        ]);

        $cmd1->execute();
        $cmd2->execute();
    }
}
