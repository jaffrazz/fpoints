<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "tanggal_efektif".
 *
 * @property integer $id_tanggal_efektif
 * @property string $tanggal_efektif
 *
 * @property \common\models\Absensi[] $absensis
 */
class TanggalEfektif extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'absensis'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal_efektif'], 'required'],
            [['tanggal_efektif'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tanggal_efektif';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tanggal_efektif' => 'Id Tanggal Efektif',
            'tanggal_efektif' => 'Tanggal Efektif',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsensis()
    {
        return $this->hasMany(\common\models\Absensi::className(), ['id_tanggal_efektif' => 'id_tanggal_efektif']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\TanggalEfektifQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\TanggalEfektifQuery(get_called_class());
    }

    /**
     * Disabled array params on search
     */
    public function formName(){
        return '';
    }
}
