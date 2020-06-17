<?php

namespace backend\controllers;

use Yii;
use common\models\Aturan;
use common\models\AturanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AturanController implements the CRUD actions for Aturan model.
 */
class AturanController extends Controller
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
     * Lists all Aturan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AturanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aturan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $new5 = $this->getPelanggaran($id)
            ->orderBy(['tanggal' => SORT_DESC])
            ->limit('5')
            ->all();
        $providerPelanggaran = new \yii\data\ArrayDataProvider([
            'allModels' => $new5
        ]);

        $totalInThisMonth = $this->getPelanggaran($id)
            ->AndWhere('month(tanggal) = month(now())')
            ->count();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerPelanggaran' => $providerPelanggaran,
            'totalInThisMonth' => $totalInThisMonth
        ]);
    }

    /**
     * Creates a new Aturan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Aturan();

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Aturan berhasil ditambahkan.");

            return $this->redirect(['view', 'id' => $model->id_aturan]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Aturan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Aturan berhasil diubah.");

            return $this->redirect(['view', 'id' => $model->id_aturan]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Aturan model.
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
            Yii::$app->session->setFlash('success', "Aturan berhasil dihapus.");
        } catch (\Exception $e) {
            $trans->rollBack();
            Yii::$app->session->setFlash('error', 'Error, cant perform this action correctly.');
        }

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the Aturan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aturan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aturan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetPasal($id){
        $number = Aturan::find()->Where(['id_kategori' => $id])->max("regexp_replace(pasal,'[A-Za-z]','')");
        
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

    function getPelanggaran($id){
        return \common\models\Pelanggaran::find()
            ->where([
                'id_aturan' => $id,
            ]);
    }
}
