<?php

namespace common\models;

use Yii;
use \common\models\base\TanggalEfektif as BaseTanggalEfektif;

/**
 * This is the model class for table "tanggal_efektif".
 */
class TanggalEfektif extends BaseTanggalEfektif
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['tanggal_efektif'], 'required'],
            [['tanggal_efektif'], 'unique']
        ]);
    }
	
}
