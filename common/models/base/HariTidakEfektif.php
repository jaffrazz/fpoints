<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "hari_tidak_efektif".
 *
 * @property integer $id_hari_tidak_efektif
 * @property string $tanggal_awal
 * @property string $tanggal_akhir
 * @property string $keterangan_tidak_efektif
 */
class HariTidakEfektif extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal_awal'], 'required'],
            [['tanggal_awal', 'tanggal_akhir'], 'safe'],
            [['keterangan_tidak_efektif'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hari_tidak_efektif';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_hari_tidak_efektif' => 'Id Hari Tidak Efektif',
            'tanggal_awal' => 'Tanggal Awal',
            'tanggal_akhir' => 'Tanggal Akhir',
            'keterangan_tidak_efektif' => 'Keterangan Tidak Efektif',
        ];
    }


    /**
     * @inheritdoc
     * @return \app\models\HariTidakEfektifQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\HariTidakEfektifQuery(get_called_class());
    }
     
    public function formName() {
        return '';
    }
}
