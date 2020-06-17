<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "detail_absensi".
 *
 * @property integer $id_detail_absensi
 * @property integer $id_absensi
 * @property integer $id_siswa
 * @property integer $id_status_absensi
 * @property string $keterangan
 *
 * @property \common\models\Absensi $absensi
 * @property \common\models\Siswa $siswa
 * @property \common\models\StatusAbsensi $statusAbsensi
 */
class DetailAbsensi extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'absensi',
            'siswa',
            'statusAbsensi'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_absensi', 'id_siswa', 'id_status_absensi'], 'required'],
            [['id_absensi', 'id_siswa', 'id_status_absensi'], 'integer'],
            [['keterangan'], 'string'],
            [
                ['id_siswa'], 
                'unique', 
                'targetAttribute' => ['id_absensi','id_siswa'],
                'message' => 'Data siswa ini telah ada, terjadi duplikasi'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_absensi';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_detail_absensi' => 'Id Detail Absensi',
            'id_absensi' => 'Absensi',
            'id_siswa' => 'Siswa',
            'id_status_absensi' => 'Status Absensi',
            'keterangan' => 'Keterangan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsensi()
    {
        return $this->hasOne(\common\models\Absensi::className(), ['id_absensi' => 'id_absensi']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswa()
    {
        return $this->hasOne(\common\models\Siswa::className(), ['id_siswa' => 'id_siswa']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusAbsensi()
    {
        return $this->hasOne(\common\models\StatusAbsensi::className(), ['id_status_absensi' => 'id_status_absensi']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\DetailAbsensiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\DetailAbsensiQuery(get_called_class());
    }

    public function formName(){
        return '';
    }
}
