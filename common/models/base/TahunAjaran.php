<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "tahun_ajaran".
 *
 * @property integer $id_tahun_ajaran
 * @property string $tahun_ajaran
 *
 * @property \common\models\AkumulasiPoint[] $akumulasiPoints
 * @property \common\models\Kelas[] $kelas
 */
class TahunAjaran extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'akumulasiPoints',
            'kelas'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun_ajaran'], 'required'],
            [['tahun_ajaran'], 'string', 'max' => 9],
            [['tahun_ajaran'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tahun_ajaran';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tahun_ajaran' => 'Id Tahun Ajaran',
            'tahun_ajaran' => 'Tahun Ajaran',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAkumulasiPoints()
    {
        return $this->hasMany(\common\models\AkumulasiPoint::className(), ['id_tahun_ajaran' => 'id_tahun_ajaran']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasMany(\common\models\Kelas::className(), ['id_tahun_ajaran' => 'id_tahun_ajaran']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\TahunAjaranQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\TahunAjaranQuery(get_called_class());
    }
     
    public function formName() {
        return '';
    }
}
