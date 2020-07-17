<?php
namespace api\v1\controllers;

use api\modules\MyActiveController;
use api\v1\models\PelanggaranSearch;
use common\models\Pelanggaran;
use Yii;

class PelanggaranController extends MyActiveController
{
    public $modelClass = Pelanggaran::class;
    public $modelSearchClass = PelanggaranSearch::class;

    public function actionIndex()
    {
        $arr = [];

        $pelanggaran = Pelanggaran::find()->all();

        if ($pelanggaran == []) {
            return $this->_notFoundAll();
        }
        foreach ($pelanggaran as $row) {
            array_push($arr, [
                'id_pelanggaran' => $row->id_pelanggaran,
                'aturan' => [
                    "pasal_aturan" => $row->aturan->pasal,
                    "uraian_aturan" => $row->aturan->uraian_aturan,
                ],
                'siswa' => [
                    'nama_siswa' => $row->siswa->nama_siswa,
                    'nama_siswa' => $row->siswa->onKelasSiswa->kelas->namaKelas->nama_kelas,
                ],
                'tanggal_pelanggaran' => $row->tanggal,
            ]);
        }

        return (new PelanggaranSearch($arr))->search(Yii::$app->request->get());
    }

    public function actionView($id)
    {
        $data = $this->findModel($id);
        $kelas = $data->siswa->onKelasSiswa->kelas;
        $aturan = $data->aturan;
        $pegawai = $kelas->waliKelas->pegawai;
        $siswa = $data->siswa;

        $aturan = [
            'id_aturan' => $aturan->id_aturan,
            'kategori_aturan' => $aturan->kategori->kategori_aturan,
            'pasal_aturan' => $aturan->pasal,
            'uraian_aturan' => $aturan->uraian_aturan,
            'tindakan' => $aturan->tindakan->tindakan,
            'point_aturan' => $aturan->point_aturan,
        ];

        $walikelas = [
            "nama_walikelas" => $pegawai->nama_pegawai,
            "alamat_walikelas" => $pegawai->alamat_pegawai,
            "agama_walikelas" => $pegawai->agama->agama,
            "jenis_kelamin_walikelas" => $pegawai->jenis_kelamin_pegawai,
            "foto_walikelas" => $pegawai->foto_pegawai,
        ];

        $siswa = [
            "id_siswa" => $siswa->id_siswa,
            "agama_siswa" => $siswa->agama->agama,
            "nis_siswa" => $siswa->nis,
            "nama_siswa" => $siswa->nama_siswa,
            "kelas" => $kelas->namaKelas->nama_kelas,
            "wali_kelas" => $walikelas,
            "jenis_kelamin_siswa" => $siswa->jenis_kelamin_siswa,
            "no_hp_siswa" => $siswa->no_hp_siswa,
            "foto_siswa" => $siswa->foto_siswa,
        ];

        return [
            'id_Pelanggaran' => $data->id_pelanggaran,
            'aturan' => $aturan,
            'siswa' => $siswa,
            'tanggal' => $data->tanggal,
        ];
    }

}
