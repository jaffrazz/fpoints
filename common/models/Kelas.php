<?php

namespace common\models;

use Yii;
use \common\models\base\Kelas as BaseKelas;

/**
 * This is the model class for table "kelas".
 */
class Kelas extends BaseKelas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id_jurusan', 'id_wali_kelas', 'id_tahun_ajaran'], 'integer'],
            [['id_tahun_ajaran', 'status', 'id_wali_kelas', 'kelas', 'grade'], 'required'],
            [['kelas', 'grade'], 'string', 'max' => 3],
            [['status'], 'string', 'max' => 1],

        ]);
    }

    public function findActive(){
        return Kelas::find()->where(['status' => 1]);
    }
	
}
