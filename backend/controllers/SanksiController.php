<?php

namespace backend\controllers;

use Yii;
use common\models\Sanksi;
use common\models\SanksiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SanksiController implements the CRUD actions for Sanksi model.
 */
class SanksiController extends Controller
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
     * Lists all Sanksi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SanksiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sanksi model.
     * @param integer $id
     * @return mixed
     */
    // public function actionView($id)
    // {
    //     $model = $this->findModel($id);
    //     $providerAkumulasiPoint = new \yii\data\ArrayDataProvider([
    //         'allModels' => $model->akumulasiPoints,
    //     ]);
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //         'providerAkumulasiPoint' => $providerAkumulasiPoint,
    //     ]);
    // }

    /**
     * Creates a new Sanksi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sanksi();

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Sanksi berhasil ditambahkan.");

            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Sanksi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Sanksi berhasil diubah.");

            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Sanksi model.
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
            Yii::$app->session->setFlash('success', "Sanksi berhasil dihapus.");
        } catch (\Exception $e) {
            $trans->rollBack();
            Yii::$app->session->setFlash('error', 'Error, cant perform this action correctly.');
        }

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the Sanksi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sanksi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sanksi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for AkumulasiPoint
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    // public function actionAddAkumulasiPoint()
    // {
    //     if (Yii::$app->request->isAjax) {
    //         $row = Yii::$app->request->post('AkumulasiPoint');
    //         if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
    //             $row[] = [];
    //         return $this->renderAjax('_formAkumulasiPoint', ['row' => $row]);
    //     } else {
    //         throw new NotFoundHttpException('The requested page does not exist.');
    //     }
    // }
}
