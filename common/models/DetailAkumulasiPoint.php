<?php

namespace common\models;

use Yii;
use \common\models\base\DetailAkumulasiPoint as BaseDetailAkumulasiPoint;

/**
 * This is the model class for table "detail_akumulasi_point".
 */
class DetailAkumulasiPoint extends BaseDetailAkumulasiPoint
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id_akumulasi_point', 'id_siswa', 'id_sanksi'], 'required'],
            [['id_akumulasi_point', 'id_siswa', 'point_pelanggaran', 'point_penghargaan', 'id_sanksi'], 'integer']
        ]);
    }
	
}
