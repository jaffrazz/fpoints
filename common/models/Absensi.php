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
            [['id_kelas', 'tanggal_efektif'], 'required'],
            [['id_kelas'], 'integer'],
            [['tanggal_efektif'], 'safe'],
            [
                'id_kelas', 
                'unique', 
                'targetAttribute' => ['id_kelas', 'tanggal_efektif'],
                'message' => 'Kelas ini telah diabsen pada tanggal tersebut.'
            ],
        ]);
    }
	
}
