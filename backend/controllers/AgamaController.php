<?php

namespace backend\controllers;

use Yii;
use common\models\Agama;
use common\models\AgamaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AgamaController implements the CRUD actions for Agama model.
 */
class AgamaController extends Controller
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
     * Lists all Agama models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AgamaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Agama model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $cntSiswa = \common\models\Siswa::find()
            ->joinWith(['onKelasSiswa'])
            ->where(['in', 'on_kelas_siswa.id_kelas',
                \common\models\Kelas::find()
                    ->where(['status' => 1])
                    ->select('id_kelas')
            ])
            ->AndWhere(['id_agama' => $model->id_agama])
            ->count();
        $cntPegawai = \common\models\Pegawai::find()
            ->AndWhere(['id_agama' => $model->id_agama])
            ->count();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'cntSiswa' => $cntSiswa,
            'cntPegawai' => $cntPegawai,
            
        ]);
    }

    /**
     * Creates a new Agama model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Agama();

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Agama berhasil ditambahkan.");
            return $this->redirect(['view', 'id' => $model->id_agama]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Agama model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Agama berhasil diubah.");
            return $this->redirect(['view', 'id' => $model->id_agama]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Agama model.
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
            Yii::$app->session->setFlash('success', "Agama berhasil dihapus.");
        } catch (\Exception $e) {
            $trans->rollBack();
            Yii::$app->session->setFlash('error', 'Error, cant perform this action correctly.');
        }

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the Agama model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Agama the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Agama::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
