<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "detail_point".
 *
 * @property integer $id_siswa
 * @property integer $point_pelanggaran
 * @property integer $point_penghargaan
 * @property integer $last_update
 *
 * @property \common\models\Siswa $siswa
 */
class DetailPoint extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'siswa'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_siswa', 'point_pelanggaran', 'point_penghargaan', 'last_update'], 'required'],
            [['id_siswa', 'point_pelanggaran', 'point_penghargaan', 'last_update'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_point';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_siswa' => 'Id Siswa',
            'point_pelanggaran' => 'Point Pelanggaran',
            'point_penghargaan' => 'Point Penghargaan',
            'last_update' => 'Last Update',
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
     * @inheritdoc
     * @return \app\models\DetailPointQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\DetailPointQuery(get_called_class());
    }
}
