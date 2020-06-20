<?php

namespace common\models;

use Yii;
use \common\models\base\DetailPoint as BaseDetailPoint;

/**
 * This is the model class for table "detail_point".
 */
class DetailPoint extends BaseDetailPoint
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id_siswa', 'last_update'], 'required'],
            [['id_siswa', 'point_pelanggaran', 'point_penghargaan'], 'integer'],
            [['last_update'], 'safe'],
        ]);
    }
	
}
