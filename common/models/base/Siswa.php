<?php

namespace common\models\base;

use Yii;

/**
 * This is the base model class for table "siswa".
 *
 * @property integer $id_siswa
 * @property integer $id_wali_murid
 * @property integer $id_agama
 * @property string $nis
 * @property string $nama_siswa
 * @property string $tempat_lahir_siswa
 * @property string $tanggal_lahir_siswa
 * @property string $jenis_kelamin_siswa
 * @property string $alamat_rumah_siswa
 * @property string $alamat_domisili_siswa
 * @property string $no_hp_siswa
 * @property string $foto_siswa
 *
 * @property \common\models\DetailAbsensi[] $detailAbsensis
 * @property \common\models\DetailAkumulasiPoint[] $detailAkumulasiPoints
 * @property \common\models\DetailPoint $detailPoint
 * @property \common\models\OnKelasSiswa $onKelasSiswa
 * @property \common\models\Kelas[] $kelas
 * @property \common\models\Pelanggaran[] $pelanggarans
 * @property \common\models\Prestasi[] $prestasis
 * @property \common\models\Agama $agama
 * @property \common\models\WaliMurid $idWaliMur
 * @property \common\models\Sp[] $sps
 */
class Siswa extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'detailAbsensis',
            'detailAkumulasiPoints',
            'detailPoint',
            'onKelasSiswa',
            'kelas',
            'pelanggarans',
            'prestasis',
            'agama',
            'idWaliMur',
            'sps'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_wali_murid', 'id_agama', 'nis', 'nama_siswa', 'tempat_lahir_siswa', 'tanggal_lahir_siswa', 'jenis_kelamin_siswa', 'alamat_rumah_siswa', 'alamat_domisili_siswa', 'no_hp_siswa'], 'required'],
            [['id_wali_murid', 'id_agama'], 'integer'],
            [['tanggal_lahir_siswa'], 'safe'],
            [['jenis_kelamin_siswa', 'alamat_rumah_siswa', 'alamat_domisili_siswa'], 'string'],
            [['nis'], 'string', 'max' => 20],
            [['nama_siswa'], 'string', 'max' => 50],
            [['tempat_lahir_siswa'], 'string', 'max' => 40],
            [['no_hp_siswa'], 'string', 'max' => 15],
            [['foto_siswa'], 'string', 'max' => 255],
            [['nis'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'siswa';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_siswa' => 'Id Siswa',
            'id_wali_murid' => 'Wali Murid',
            'id_agama' => 'Agama',
            'nis' => 'NIS',
            'nama_siswa' => 'Nama',
            'tempat_lahir_siswa' => 'Tempat Lahir',
            'tanggal_lahir_siswa' => 'Tanggal Lahir',
            'jenis_kelamin_siswa' => 'Jenis Kelamin',
            'alamat_rumah_siswa' => 'Alamat Rumah',
            'alamat_domisili_siswa' => 'Alamat Domisili',
            'no_hp_siswa' => 'No HP',
            'foto_siswa' => 'Foto',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailAbsensis()
    {
        return $this->hasMany(\common\models\DetailAbsensi::className(), ['id_siswa' => 'id_siswa']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailAkumulasiPoints()
    {
        return $this->hasMany(\common\models\DetailAkumulasiPoint::className(), ['id_siswa' => 'id_siswa']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPoint()
    {
        return $this->hasOne(\common\models\DetailPoint::className(), ['id_siswa' => 'id_siswa']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOnKelasSiswa()
    {
        return $this->hasOne(\common\models\OnKelasSiswa::className(), ['id_siswa' => 'id_siswa']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasMany(\common\models\Kelas::className(), ['id_kelas' => 'id_kelas'])->viaTable('on_kelas_siswa', ['id_siswa' => 'id_siswa']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPelanggarans()
    {
        return $this->hasMany(\common\models\Pelanggaran::className(), ['id_siswa' => 'id_siswa']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrestasis()
    {
        return $this->hasMany(\common\models\Prestasi::className(), ['id_siswa' => 'id_siswa']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgama()
    {
        return $this->hasOne(\common\models\Agama::className(), ['id_agama' => 'id_agama']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdWaliMur()
    {
        return $this->hasOne(\common\models\WaliMurid::className(), ['id_wali_murid' => 'id_wali_murid']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSps()
    {
        return $this->hasMany(\common\models\Sp::className(), ['id_siswa' => 'id_siswa']);
    }
    

    /**
     * @inheritdoc
     * @return \app\models\SiswaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\SiswaQuery(get_called_class());
    }

    public function formName(){
        return '';
    }
}
