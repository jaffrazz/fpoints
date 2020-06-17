<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "absensi".
 *
 * @property integer $id_absensi
 * @property integer $id_siswa
 * @property integer $id_status_absensi
 * @property integer $id_tanggal_efektif
 * @property string $keterangan
 *
 * @property \common\models\Siswa $siswa
 * @property \common\models\StatusAbsensi $statusAbsensi
 * @property \common\models\TanggalEfektif $tanggalEfektif
 */
class Absensi extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'siswa',
            'statusAbsensi',
            'tanggalEfektif'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_siswa', 'id_status_absensi', 'id_tanggal_efektif'], 'required'],
            [['id_siswa', 'id_status_absensi', 'id_tanggal_efektif'], 'integer'],
            [['keterangan'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'absensi';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_absensi' => 'Id Absensi',
            'id_siswa' => 'Siswa',
            'id_status_absensi' => 'Status Absensi',
            'id_tanggal_efektif' => 'Tanggal Efektif',
            'keterangan' => 'Keterangan',
        ];
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
     * @return \yii\db\ActiveQuery
     */
    public function getTanggalEfektif()
    {
        return $this->hasOne(\common\models\TanggalEfektif::className(), ['id_tanggal_efektif' => 'id_tanggal_efektif']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\AbsensiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\AbsensiQuery(get_called_class());
    }
     
    public function formName() {
        return '';
    }
}
