<?php

namespace common\models;

use Yii;
use \common\models\base\HariTidakEfektif as BaseHariTidakEfektif;

/**
 * This is the model class for table "hari_tidak_efektif".
 */
class HariTidakEfektif extends BaseHariTidakEfektif
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id_hari_tidak_efektif'], 'required'],
            [['id_hari_tidak_efektif'], 'integer'],
            [['tanggal_tidak_efektif'], 'safe'],
            [['keterangan_tidak_efektif'], 'string']
        ]);
    }
	
}
