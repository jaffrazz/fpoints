<?php

namespace common\models;

use Yii;
use \common\models\base\Pegawai as BasePegawai;
use borales\extensions\phoneInput\PhoneInputValidator;
/**
 * This is the model class for table "pegawai".
 */
class Pegawai extends BasePegawai
{
    /**
     * This ist temp variable to upload photo
     */
    public $photo;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id_agama', 'nama_pegawai', 'alamat_pegawai', 'jenis_kelamin_pegawai', 'no_hp_pegawai', 'status_kepegawaian', 'jabatan_pegawai'], 'required'],
            [['id_agama', 'jabatan_pegawai'], 'integer'],
            [['alamat_pegawai', 'jenis_kelamin_pegawai'], 'string'],
            [['nama_pegawai'], 'string', 'max' => 100],
            [['no_hp_pegawai'], 'string', 'max' => 15],
            [['status_kepegawaian'], 'string', 'max' => 50],
            [['foto_pegawai'], 'string', 'max' => 255],
            [['no_hp_pegawai'],  PhoneInputValidator::className()],
            [['photo'],'file', 'skipOnEmpty' => true, 'extensions'=>'jpg,jpeg,gif,png,jpeg', 'maxSize' => 1024*1024*3],
        ]);
    }
	
}
