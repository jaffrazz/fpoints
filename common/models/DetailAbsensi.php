<?php

namespace common\models;

use Yii;
use \common\models\base\DetailAbsensi as BaseDetailAbsensi;

/**
 * This is the model class for table "detail_absensi".
 */
class DetailAbsensi extends BaseDetailAbsensi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id_absensi', 'id_siswa', 'id_status_absensi'], 'required'],
            [['id_absensi', 'id_siswa', 'id_status_absensi'], 'integer'],
            [['keterangan'], 'string']
        ]);
    }
	
}
