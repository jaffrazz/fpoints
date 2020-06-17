<?php

namespace common\models;

use Yii;
use \common\models\base\Absensi as BaseAbsensi;

/**
 * This is the model class for table "absensi".
 */
class Absensi extends BaseAbsensi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id_siswa', 'id_status_absensi', 'id_tanggal_efektif'], 'required'],
            [['id_siswa', 'id_status_absensi', 'id_tanggal_efektif'], 'integer'],
            [['keterangan'], 'string']
        ]);
    }
	
}
