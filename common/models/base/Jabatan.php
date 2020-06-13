<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "jabatan".
 *
 * @property integer $id_jabatan
 * @property string $jabatan
 *
 * @property \common\models\Pegawai[] $pegawais
 */
class Jabatan extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'pegawais'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jabatan'], 'required'],
            [['jabatan'], 'string', 'max' => 30],
            [['jabatan'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jabatan';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_jabatan' => 'Id Jabatan',
            'jabatan' => 'Jabatan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawais()
    {
        return $this->hasMany(\common\models\Pegawai::className(), ['jabatan_pegawai' => 'id_jabatan']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\JabatanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\JabatanQuery(get_called_class());
    }
}
