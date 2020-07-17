<?php
namespace api\v1\controllers;

use api\modules\MyActiveController;
use api\v1\models\AturanSearch;
use common\models\Aturan;
use Yii;

class AturanController extends MyActiveController
{
    public $modelClass = Aturan::class;
    public $modelSearchClass = AturanSearch::class;

    public function actionIndex()
    {
        $arr = [];

        $aturan = Aturan::find()->all();

        if ($aturan == []) {
            return $this->_notFoundAll();
        }

        foreach ($aturan as $row) {
            array_push($arr, [
                'id_aturan' => $row->id_aturan,
                'kategori_aturan' => $row->kategori->kategori_aturan,
                'pasal_aturan' => $row->pasal,
                'uraian_aturan' => $row->uraian_aturan,
                'tindakan' => $data->tindakan->tindakan,
                'point_aturan' => $row->point_aturan,
            ]);
        }

        return (new AturanSearch($arr))->search(Yii::$app->request->get());
    }

    public function actionView($id)
    {
        $data = $this->findModel($id);

        return [
            'id_aturan' => $data->id_aturan,
            'kategori_aturan' => $data->kategori->kategori_aturan,
            'pasal_aturan' => $data->pasal,
            'uraian_aturan' => $data->uraian_aturan,
            'tindakan' => $data->tindakan->tindakan,
            'point_aturan' => $data->point_aturan,
        ];
    }

}
