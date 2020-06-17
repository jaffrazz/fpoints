<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "absensi".
 *
 * @property integer $id_absensi
 * @property integer $id_kelas
 * @property integer $id_tanggal_efektif
 *
 * @property \common\models\Kelas $kelas
 * @property \common\models\TanggalEfektif $tanggalEfektif
 * @property \common\models\DetailAbsensi[] $detailAbsensis
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
            'kelas',
            'tanggalEfektif',
            'detailAbsensis'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kelas', 'id_tanggal_efektif'], 'required'],
            [['id_kelas', 'id_tanggal_efektif'], 'integer'],
            [
                'id_kelas', 
                'unique', 
                'targetAttribute' => ['id_kelas', 'id_tanggal_efektif'],
                'message' => 'Kelas ini telah diabsen pada tanggal tersebut.'
            ],
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
            'id_kelas' => 'Kelas',
            'id_tanggal_efektif' => 'Tanggal Efektif',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasOne(\common\models\Kelas::className(), ['id_kelas' => 'id_kelas']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTanggalEfektif()
    {
        return $this->hasOne(\common\models\TanggalEfektif::className(), ['id_tanggal_efektif' => 'id_tanggal_efektif']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailAbsensis()
    {
        return $this->hasMany(\common\models\DetailAbsensi::className(), ['id_absensi' => 'id_absensi']);
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
