<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "semester".
 *
 * @property integer $id_semester
 * @property string $semester
 * @property string $awal_bulan_semester
 * @property string $akhir_bulan_semester
 *
 * @property \common\models\AkumulasiPoint[] $akumulasiPoints
 */
class Semester extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'akumulasiPoints'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['semester', 'awal_bulan_semester', 'akhir_bulan_semester'], 'required'],
            [['semester', 'awal_bulan_semester', 'akhir_bulan_semester'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semester';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_semester' => 'Id Semester',
            'semester' => 'Semester',
            'awal_bulan_semester' => 'Awal Bulan',
            'akhir_bulan_semester' => 'Akhir Bulan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAkumulasiPoints()
    {
        return $this->hasMany(\common\models\AkumulasiPoint::className(), ['id_semester' => 'id_semester']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\SemesterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\SemesterQuery(get_called_class());
    }
     
    public function formName() {
        return '';
    }
}
