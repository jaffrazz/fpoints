<?php
namespace api\v1\controllers;

use api\modules\MyActiveController;
use api\v1\models\KelasSearch;
use common\models\Agama;
use common\models\Jurusan;
use common\models\Kelas;
use common\models\NamaKelas;
use common\models\Pegawai;
use common\models\Siswa;
use common\models\TahunAjaran;
use Yii;

class KelasController extends MyActiveController
{
    public $modelClass = Kelas::class;
    public $modelSearchClass = KelasSearch::class;

    public function actionIndex()
    {
        $arr = [];
        $kelas = Kelas::find()->where(['status' => 1])->all();
        foreach ($kelas as $row) {
            $pegawai = Pegawai::findOne($row->waliKelas->id_pegawai);

            $arr[] = [
                "id_kelas" => $row->id_kelas,
                "nama_kelas" => NamaKelas::findOne($row->id_kelas)->nama_kelas,
                "jurusan" => //[
                    // "nama_jurusan" => 
                    $row->jurusan->jurusan,
                    // "kepala_jurusan" => $row->jurusan->kepala_jurusan,
                // ],
                "jml_siswa" => Siswa::find($row->id_kelas)->count(),
                // "siswa" => $siswa,
                "walikelas" => [
                    "nama_walikelas" => $pegawai->nama_pegawai,
                    // "alamat_walikelas" => $pegawai->alamat_pegawai,
                    // "agama_walikelas" => $pegawai->agama->agama,
                    // "jenis_kelamin_walikelas" => $pegawai->jenis_kelamin_pegawai,
                    "foto_walikelas" => $pegawai->foto_pegawai,
                ],
                "tahun_ajaran" => TahunAjaran::findOne($row->id_tahun_ajaran)->tahun_ajaran,
                "status_kelas" => $row->status,
            ];
        }

        return (new KelasSearch($arr))->search(Yii::$app->request->get());
    }

    public function actionView($id)
    {
        $kelas = $this->findModel($id);
        $list_siswa = Siswa::find($kelas->id_kelas)->all();
        $pegawai = Pegawai::findOne($kelas->waliKelas->id_pegawai);
        $siswa = [];

        foreach ($list_siswa as $sis) {
            array_push($siswa, [
                "id_siswa" => $sis->id_siswa,
                "id_agama" => $sis->agama->agama,
                "nis_siswa" => $sis->nis,
                "nama_siswa" => $sis->nama_siswa,
                "tempat_lahir_siswa" => $sis->tempat_lahir_siswa,
                "tanggal_lahir_siswa" => $sis->tanggal_lahir_siswa,
                "jenis_kelamin_siswa" => $sis->jenis_kelamin_siswa,
                "alamat_rumah_siswa" => $sis->alamat_rumah_siswa,
                "alamat_domisili_siswa" => $sis->alamat_domisili_siswa,
                "no_hp_siswa" => $sis->no_hp_siswa,
                "foto_siswa" => $sis->foto_siswa,
            ]);
        }

        $arr = [
            "id_kelas" => $kelas->id_kelas,
            "nama_kelas" => NamaKelas::findOne($kelas->id_kelas)->nama_kelas,
            "jurusan" => [
                "nama_jurusan" => $kelas->jurusan->jurusan,
                "kepala_jurusan" => $kelas->jurusan->kepala_jurusan,
            ],
            "jml_siswa" => Siswa::find($kelas->id_kelas)->count(),
            "siswa" => $siswa,
            "walikelas" => [
                "nama_walikelas" => $pegawai->nama_pegawai,
                "alamat_walikelas" => $pegawai->alamat_pegawai,
                "agama_walikelas" => $pegawai->agama->agama,
                "jenis_kelamin_walikelas" => $pegawai->jenis_kelamin_pegawai,
                "foto_walikelas" => $pegawai->foto_pegawai,
            ],
            "tahun_ajaran" => TahunAjaran::findOne($kelas->id_tahun_ajaran)->tahun_ajaran,
            "status_kelas" => $kelas->status,
        ];

        return $arr;
    }
}
