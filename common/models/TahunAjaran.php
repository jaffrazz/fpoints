<?php

namespace common\models;

use Yii;
use \common\models\base\TahunAjaran as BaseTahunAjaran;

/**
 * This is the model class for table "tahun_ajaran".
 */
class TahunAjaran extends BaseTahunAjaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['tahun_ajaran'], 'required'],
            [['tahun_ajaran'], 'string', 'max' => 9]
        ]);
    }
	
}
