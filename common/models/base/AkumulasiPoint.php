<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "akumulasi_point".
 *
 * @property integer $id_akumulasi_point
 * @property integer $id_tahun_ajaran
 * @property integer $id_semester
 *
 * @property \common\models\TahunAjaran $tahunAjaran
 * @property \common\models\Semester $semester
 * @property \common\models\DetailAkumulasiPoint[] $detailAkumulasiPoints
 */
class AkumulasiPoint extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'tahunAjaran',
            'semester',
            'detailAkumulasiPoints'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tahun_ajaran', 'id_semester'], 'required'],
            [['id_tahun_ajaran', 'id_semester'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'akumulasi_point';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_akumulasi_point' => 'Id Akumulasi Point',
            'id_tahun_ajaran' => 'Id Tahun Ajaran',
            'id_semester' => 'Id Semester',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahunAjaran()
    {
        return $this->hasOne(\common\models\TahunAjaran::className(), ['id_tahun_ajaran' => 'id_tahun_ajaran']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemester()
    {
        return $this->hasOne(\common\models\Semester::className(), ['id_semester' => 'id_semester']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailAkumulasiPoints()
    {
        return $this->hasMany(\common\models\DetailAkumulasiPoint::className(), ['id_akumulasi_point' => 'id_akumulasi_point']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'last_update',
                'updatedAtAttribute' => 'last_update',
                'value' => new Expression('now()'),
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \app\models\AkumulasiPointQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\AkumulasiPointQuery(get_called_class());
    }
}
