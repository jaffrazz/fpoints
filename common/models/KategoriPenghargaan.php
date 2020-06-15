<?php

namespace common\models;

use Yii;
use \common\models\base\KategoriPenghargaan as BaseKategoriPenghargaan;

/**
 * This is the model class for table "kategori_penghargaan".
 */
class KategoriPenghargaan extends BaseKategoriPenghargaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['kategori_penghargaan'], 'required'],
            [['kategori_penghargaan'], 'string']
        ]);
    }
	
}
