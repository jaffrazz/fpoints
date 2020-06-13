<?php

namespace common\models;

use Yii;
use \common\models\base\Jabatan as BaseJabatan;

/**
 * This is the model class for table "jabatan".
 */
class Jabatan extends BaseJabatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['jabatan'], 'required'],
            [['jabatan'], 'string', 'max' => 30],
            [['jabatan'], 'unique']
        ]);
    }
	
}
