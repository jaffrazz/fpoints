<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */

$this->title = $model->nama_siswa;
$this->params['breadcrumbs'][] = ['label' => 'Siswa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="siswa-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">

                    <?=Html::a('Update', ['update', 'id' => $model->id_siswa], ['class' => 'btn btn-primary'])?>
                    <?=Html::a('Delete', ['delete', 'id' => $model->id_siswa], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </div>
                <div class="box-body">
                    <!-- <div class="row"> -->
                    <?php
                        $gridColumn = [
                            ['attribute' => 'id_siswa', 'visible' => false],
                            'nis',
                            'nama_siswa',
                            [
                                'attribute' => 'TTL',
                                'label' => 'TTL',
                                'value' => function($model){
                                    return $model->tempat_lahir_siswa. ", " .$model->tanggal_lahir_siswa;
                                }
                            ],
                            'tempat_lahir_siswa',
                            'tanggal_lahir_siswa',
                            [
                                'attribute' => 'jenis_kelamin_siswa',
                                'label' => 'Jenis Kelamin',
                                'value' => function($model) { return ($model->jenis_kelamin_siswa == 'L') ? 'Laki-laki' : 'Perempuan'; }
                            ],
                            [
                                'attribute' => 'agama.agama',
                                'label' => 'Agama',
                            ],
                            'alamat_rumah_siswa:ntext',
                            'alamat_domisili_siswa:ntext',
                            'no_hp_siswa',
                            [
                                'attribute' => 'waliMurid.id_wali_murid',
                                'label' => 'Wali Murid',
                                'value' => function($model) { return $model->idWaliMur->nama_wali_murid; }
                            ],
                            'foto_siswa',
                        ];
                        echo DetailView::widget([
                            'model' => $model,
                            'attributes' => $gridColumn,
                        ]);
                        ?>

                    <div class="pt-3">
                        <h3>
                            <b>Kelas</b>
                        </h3>
                            <?php
                            $gridColumnKelas = [
                                [
                                    'attribute' => 'kelas',
                                    'value' => function($model){
                                        return $model->onKelasSiswa->kelas->namaKelas->nama_kelas;
                                    }
                                ],
                                [
                                    'attribute' => 'nama_wali_kelas',
                                    'value' => function($model){
                                        return $model->onKelasSiswa->kelas->waliKelas->pegawai->nama_pegawai;
                                    }
                                ],
                                [
                                    'attribute' => 'anggota_kelas',
                                    'value' => function($model){
                                        return count($model->onKelasSiswa->kelas->onKelasSiswas). " Orang";
                                    }
                                ],
                            ];
                                
                            echo DetailView::widget([
                                'model' => $model,
                                'attributes' => $gridColumnKelas,
                            ]);
                             ?>
                    </div>

                    <div class="<?php if ($providerAbsensi->totalCount) {?>pt-3<?php }?>">
                        <?php
                            if ($providerAbsensi->totalCount) {
                                $gridColumnAbsensi = [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    ['attribute' => 'id_siswa', 'visible' => false],
                                    [
                                        'attribute' => 'statusAbsensi.id_status_absensi',
                                        'label' => 'Id Status Absensi',
                                    ],
                                    'tanggal',
                                ];
                                echo Gridview::widget([
                                    'dataProvider' => $providerAbsensi,
                                    'pjax' => true,
                                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-absensi']],
                                    'panel' => [
                                        //'type' => GridView::TYPE_PRIMARY,
                                        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Absensi'),
                                    ],
                                    'export' => false,
                                    'columns' => $gridColumnAbsensi,
                                ]);
                            }
                            ?>

                    </div>

                        <div class="<?php if ($providerAkumulasiPoint->totalCount) { ?>pt-3<?php }?>">
                        <?php
                            if ($providerAkumulasiPoint->totalCount) {
                                $gridColumnAkumulasiPoint = [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    ['attribute' => 'id_siswa', 'visible' => false],
                                    [
                                        'attribute' => 'sanksi.id_sanksi',
                                        'label' => 'Id Sanksi',
                                    ],
                                    'tanggal',
                                ];
                                echo Gridview::widget([
                                    'dataProvider' => $providerAkumulasiPoint,
                                    'pjax' => true,
                                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-akumulasi-point']],
                                    'panel' => [
                                        //'type' => GridView::TYPE_PRIMARY,
                                        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Akumulasi Point'),
                                    ],
                                    'export' => false,
                                    'columns' => $gridColumnAkumulasiPoint,
                                ]);
                            }
                            ?>

                    </div>
                    <div class="<?php if ($providerPelanggaran->totalCount) {?>pt-3<?php }?>">
                        <?php
                            if ($providerPelanggaran->totalCount) {
                                $gridColumnPelanggaran = [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    ['attribute' => 'id_siswa', 'visible' => false],
                                    [
                                        'attribute' => 'aturan.id_aturan',
                                        'label' => 'Id Aturan',
                                    ],
                                    'tanggal',
                                ];
                                echo Gridview::widget([
                                    'dataProvider' => $providerPelanggaran,
                                    'pjax' => true,
                                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-pelanggaran']],
                                    'panel' => [
                                        //'type' => GridView::TYPE_PRIMARY,
                                        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Pelanggaran'),
                                    ],
                                    'export' => false,
                                    'columns' => $gridColumnPelanggaran,
                                ]);
                            }
                            ?>

                    </div>

                    <div class="<?php if ($providerPrestasi->totalCount) {?>pt-3<?php }?>">
                        <?php
                            if ($providerPrestasi->totalCount) {
                                $gridColumnPrestasi = [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    ['attribute' => 'id_siswa', 'visible' => false],
                                    [
                                        'attribute' => 'penghargaan.id_penghargaan',
                                        'label' => 'Id Penghargaan',
                                    ],
                                    'tanggal',
                                ];
                                echo Gridview::widget([
                                    'dataProvider' => $providerPrestasi,
                                    'pjax' => true,
                                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-prestasi']],
                                    'panel' => [
                                        //'type' => GridView::TYPE_PRIMARY,
                                        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Prestasi'),
                                    ],
                                    'export' => false,
                                    'columns' => $gridColumnPrestasi,
                                ]);
                            }
                            ?>

                    </div>
                    <div class="pt-3">
                        <h3><b>Wali Murid</b></h3>
                    </div>
                    <?php
                        $gridColumnWaliMurid = [
                            'nama_wali_murid',
                            [
                                'attribute' => 'ttl',
                                'label' => 'TTL',
                                'value' => function($model) {
                                    return $model->tempat_lahir_wali_murid. ", ".$model->tanggal_lahir_wali_murid ;
                                }
                            ],
                            [
                                'attribute' => 'agama.agama',
                                'label' => 'Agama',
                                'value' => function($model) {
                                    return $model->agama->agama;
                                }
                            ],
                            [
                                'attribute' => 'jenis_kelamin_wali_murid',
                                'label' => 'Jenis Kelamin',
                                'value' => function($model) { return ($model->jenis_kelamin_wali_murid == 'L') ? 'Laki-laki' : 'Perempuan'; }
                            ],
                            [
                                'attribute' => 'id_pekerjaan',
                                'label' => 'Pekerjaan',
                                'value' => function($model) {
                                    return $model->pekerjaan->nama_pekerjaan;
                                }
                            ],
                            'alamat_rumah_wali_murid',
                            'no_hp_wali_murid',
                        ];
                        echo DetailView::widget([
                            'model' => $model->idWaliMur,
                            'attributes' => $gridColumnWaliMurid]);
                        ?>

                    <div class="pt-3">
                        <?php
                            if ($providerSp->totalCount) {
                                $gridColumnSp = [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'id_sp',
                                    ['attribute' => 'id_siswa', 'visible' => false],
                                    'tanggal_sp',
                                    'jml_point_pelanggaran',
                                ];
                                echo Gridview::widget([
                                    'dataProvider' => $providerSp,
                                    'pjax' => true,
                                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-sp']],
                                    'panel' => [
                                        //'type' => GridView::TYPE_PRIMARY,
                                        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Sp'),
                                    ],
                                    'export' => false,
                                    'columns' => $gridColumnSp,
                                ]);
                            }
                            ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>