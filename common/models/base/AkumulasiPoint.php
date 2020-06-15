<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "akumulasi_point".
 *
 * @property integer $id_siswa
 * @property integer $id_sanksi
 * @property integer $total_point
 * @property string $tanggal
 * @property integer $id_tahun_ajaran
 * @property integer $id_semester
 *
 * @property \common\models\Siswa $siswa
 * @property \common\models\Sanksi $sanksi
 * @property \common\models\TahunAjaran $tahunAjaran
 * @property \common\models\Semester $semester
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
            'siswa',
            'sanksi',
            'tahunAjaran',
            'semester'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_siswa', 'id_sanksi', 'total_point', 'id_tahun_ajaran', 'id_semester'], 'required'],
            [['id_siswa', 'id_sanksi', 'total_point', 'id_tahun_ajaran', 'id_semester'], 'integer'],
            [['tanggal'], 'safe']
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
            'id_siswa' => 'Siswa',
            'id_sanksi' => 'Sanksi',
            'total_point' => 'Total Point',
            'tanggal' => 'Tanggal',
            'id_tahun_ajaran' => 'Tahun Ajaran',
            'id_semester' => 'Semester',
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
     * @return \yii\db\ActiveQuery
     */
    public function getSanksi()
    {
        return $this->hasOne(\common\models\Sanksi::className(), ['id_sanksi' => 'id_sanksi']);
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
     * @inheritdoc
     * @return \app\models\AkumulasiPointQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\AkumulasiPointQuery(get_called_class());
    }
     
    public function formName() {
        return '';
    }
}
