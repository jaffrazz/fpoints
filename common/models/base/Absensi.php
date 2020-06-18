<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "absensi".
 *
 * @property integer $id_absensi
 * @property integer $id_kelas
 * @property string $tanggal_efektif
 *
 * @property \common\models\Kelas $kelas
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
            'detailAbsensis'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kelas', 'tanggal_efektif'], 'required'],
            [['id_kelas'], 'integer'],
            [['tanggal_efektif'], 'safe'],
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
            'tanggal_efektif' => 'Tanggal Efektif',
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
