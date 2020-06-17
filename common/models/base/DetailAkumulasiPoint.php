<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "detail_akumulasi_point".
 *
 * @property integer $id_detail_akumulasi_point
 * @property integer $id_siswa
 * @property integer $id_akumulasi_point
 * @property integer $point_pelanggaran
 * @property integer $point_penghargaan
 * @property integer $id_sanksi
 *
 * @property \common\models\AkumulasiPoint $akumulasiPoint
 * @property \common\models\Sanksi $sanksi
 * @property \common\models\Siswa $siswa
 */
class DetailAkumulasiPoint extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'akumulasiPoint',
            'sanksi',
            'siswa'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_siswa', 'id_akumulasi_point', 'point_pelanggaran', 'point_penghargaan', 'id_sanksi'], 'required'],
            [['id_siswa', 'id_akumulasi_point', 'point_pelanggaran', 'point_penghargaan', 'id_sanksi'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_akumulasi_point';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_detail_akumulasi_point' => 'Id Detail Akumulasi Point',
            'id_siswa' => 'Id Siswa',
            'id_akumulasi_point' => 'Id Akumulasi Point',
            'point_pelanggaran' => 'Point Pelanggaran',
            'point_penghargaan' => 'Point Penghargaan',
            'id_sanksi' => 'Id Sanksi',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAkumulasiPoint()
    {
        return $this->hasOne(\common\models\AkumulasiPoint::className(), ['id_akumulasi_point' => 'id_akumulasi_point']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSanksi()
    {
        return $this->hasOne(\common\models\Sanksi::className(), ['id_sanksi' => 'id_sanksi']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswa()
    {
        return $this->hasOne(\common\models\Siswa::className(), ['id_siswa' => 'id_siswa']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\DetailAkumulasiPointQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\DetailAkumulasiPointQuery(get_called_class());
    }
}
