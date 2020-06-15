<?php

namespace common\models;

use Yii;
use \common\models\base\Semester as BaseSemester;

/**
 * This is the model class for table "semester".
 */
class Semester extends BaseSemester
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['semester', 'awal_bulan_semester', 'akhir_bulan_semester'], 'required'],
            [['semester', 'awal_bulan_semester', 'akhir_bulan_semester'], 'string']
        ]);
    }
	
}
