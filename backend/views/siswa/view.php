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
                            'value' => function ($model) {
                                return $model->tempat_lahir_siswa . ", " . $model->tanggal_lahir_siswa;
                            },
                        ],
                        [
                            'attribute' => 'jenis_kelamin_siswa',
                            'label' => 'Jenis Kelamin',
                            'value' => function ($model) {return ($model->jenis_kelamin_siswa == 'L') ? 'Laki-laki' : 'Perempuan';},
                        ],
                        [
                            'attribute' => 'agama.agama',
                            'label' => 'Agama',
                        ],
                        'alamat_rumah_siswa:ntext',
                        'alamat_domisili_siswa:ntext',
                        [
                            'attribute' => 'kelas',
                            'value' => function($model){
                                return $model->onKelasSiswa->kelas->namaKelas->nama_kelas;
                            }
                        ],
                        'no_hp_siswa',
                        [
                            'attribute' => 'waliMurid.id_wali_murid',
                            'label' => 'Wali Murid',
                            'value' => function ($model) {return $model->idWaliMur->nama_wali_murid;},
                        ],
                        'foto_siswa',
                    ];
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => $gridColumn,
                    ]);
                    ?>


                    <div class="pt-3">
                        <h3><b>Wali Murid</b></h3>
                    </div>
                    <?php
                    $gridColumnWaliMurid = [
                        'nama_wali_murid',
                        [
                            'attribute' => 'ttl',
                            'label' => 'TTL',
                            'value' => function ($model) {
                                return $model->tempat_lahir_wali_murid . ", " . $model->tanggal_lahir_wali_murid;
                            },
                        ],
                        [
                            'attribute' => 'agama.agama',
                            'label' => 'Agama',
                            'value' => function ($model) {
                                return $model->agama->agama;
                            },
                        ],
                        [
                            'attribute' => 'jenis_kelamin_wali_murid',
                            'label' => 'Jenis Kelamin',
                            'value' => function ($model) {return ($model->jenis_kelamin_wali_murid == 'L') ? 'Laki-laki' : 'Perempuan';},
                        ],
                        [
                            'attribute' => 'id_pekerjaan',
                            'label' => 'Pekerjaan',
                            'value' => function ($model) {
                                return $model->pekerjaan->nama_pekerjaan;
                            },
                        ],
                        'alamat_rumah_wali_murid',
                        'no_hp_wali_murid',
                    ];
                    echo DetailView::widget([
                        'model' => $model->idWaliMur,
                        'attributes' => $gridColumnWaliMurid]);
                    ?>


                    <?php if ($providerDetailAbsensi->totalCount) {?>
                        <div class="pt-3">
                        <?php
                        $gridColumnDetailAbsensi = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id_siswa', 'visible' => false],
                            [
                                'attribute' => 'absensi.tanggal',
                                'label' => 'Tanggal',
                                'value' => function($model){
                                    return $model->absensi->tanggal_efektif;
                                }
                            ],
                            [
                                'attribute' => 'statusAbsensi.id_status_absensi',
                                'label' => 'Status Absensi',
                                'value' => function($model){
                                    return $model->statusAbsensi->keterangan_status_absensi;
                                }
                            ],
                            'keterangan:ntext',
                        ];
                        echo Gridview::widget([
                            'dataProvider' => $providerDetailAbsensi,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-detail-absensi']],
                            'panel' => [
                                //'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Daftar Absensi'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnDetailAbsensi,
                        ]);
                        ?>
                        </div>
                    <?php }?>


                    <?php if ($providerDetailAkumulasiPoint->totalCount) {?>
                        <div class="pt-3">
                        <?php
                        $gridColumnDetailAkumulasiPoint = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id_siswa', 'visible' => false],
                            [
                                'attribute' => 'akumulasiPoint.id_akumulasi_point',
                                'label' => 'Akumulasi Point',
                            ],
                            'point_pelanggaran',
                            'point_penghargaan',
                            [
                                'attribute' => 'sanksi.id_sanksi',
                                'label' => 'Sanksi',
                            ],
                        ];
                        echo Gridview::widget([
                            'dataProvider' => $providerDetailAkumulasiPoint,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-detail-akumulasi-point']],
                            'panel' => [
                                //'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Detail Akumulasi Point'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnDetailAkumulasiPoint,
                        ]);
                        ?>
                        </div>
                    <?php }?>

                    <?php if ($model->detailPoint != null) {?>
                        <div class="pt-3">
                            <h3><b>Detail Point</b></h3>
                        </div>
                        <?php
                        $gridColumnDetailPoint = [
                            'point_pelanggaran',
                            'point_penghargaan',
                            'last_update',
                        ];
                            echo DetailView::widget([
                                'model' => $model->detailPoint,
                                'attributes' => $gridColumnDetailPoint]);
                        }
                    ?>

                    <?php if ($providerPelanggaran->totalCount) {?>
                        <div class="pt-3">
                        <?php
                        $gridColumnPelanggaran = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id_siswa', 'visible' => false],
                            [
                                'attribute' => 'aturan.id_aturan',
                                'label' => 'Aturan',
                                'value' => function($model){
                                    return $model->aturan->uraian_aturan;
                                }
                            ],
                            'tanggal',
                        ];
                        echo Gridview::widget([
                            'dataProvider' => $providerPelanggaran,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-pelanggaran']],
                            'panel' => [
                                //'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Daftar Pelanggaran'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnPelanggaran,
                        ]);
                        ?>
                        </div>
                    <?php }?>

                    <?php if ($providerPrestasi->totalCount) {?>
                        <div class="pt-3">
                        <?php
                        $gridColumnPrestasi = [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'id_siswa', 'visible' => false],
                            [
                                'attribute' => 'penghargaan.id_penghargaan',
                                'label' => 'Penghargaan',
                                'value' => function($model){
                                    return $model->penghargaan->uraian_penghargaan;
                                }
                            ],
                            'tanggal',
                        ];
                        echo Gridview::widget([
                            'dataProvider' => $providerPrestasi,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-prestasi']],
                            'panel' => [
                                //'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Daftar Prestasi'),
                            ],
                            'export' => false,
                            'columns' => $gridColumnPrestasi,
                        ]);
                        ?>
                        </div>
                    <?php }?>


                    <?php if ($providerSp->totalCount) {?>
                        <div class="pt-3">
                            <?php
                            $gridColumnSp = [
                                ['class' => 'yii\grid\SerialColumn'],
                                'id_sp',
                                ['attribute' => 'id_siswa', 'visible' => false],
                                'sp_ke',
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
                            ?>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

</div>