<?php

namespace backend\controllers;

use Yii;
use common\models\KategoriPenghargaan;
use common\models\KategoriPenghargaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KategoriPenghargaanController implements the CRUD actions for KategoriPenghargaan model.
 */
class KategoriPenghargaanController extends Controller
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
     * Lists all KategoriPenghargaan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KategoriPenghargaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KategoriPenghargaan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerPenghargaan = new \yii\data\ArrayDataProvider([
            'allModels' => $model->penghargaans,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerPenghargaan' => $providerPenghargaan,
        ]);
    }

    /**
     * Creates a new KategoriPenghargaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new KategoriPenghargaan();

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Kategori Penghargaan berhasil ditambahkan.");

            return $this->redirect(['view', 'id' => $model->id_kategori_penghargaan]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing KategoriPenghargaan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Kategori Penghargaan berhasil diubah.");
            return $this->redirect(['view', 'id' => $model->id_kategori_penghargaan]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing KategoriPenghargaan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $trans = Yii::$app->db->beginTransaction();
        try {
            $this->findModel($id)->deleteWithRrelated();
            $trans->commit();
            Yii::$app->session->setFlash('success', "Kategori Penghargaan berhasil dihapus.");
        } catch (\Exception $e) {
            $trans->rollBack();
            Yii::$app->session->setFlash('error', 'Error, cant perform this action correctly.');
        }


        return $this->redirect(['index']);
    }

    
    /**
     * Finds the KategoriPenghargaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KategoriPenghargaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KategoriPenghargaan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
