<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Kelas */

$this->title = $model->kelas;
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">

                    <?=Html::a('Update', ['update', 'id' => $model->id_kelas], ['class' => 'btn btn-primary'])?>
                    <?=Html::a('Delete', ['delete', 'id' => $model->id_kelas], [
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
                        ['attribute' => 'id_kelas', 'visible' => false],
                        [
                            'attribute' => 'nama_kelas',
                            'label' => 'Kelas',
                            'value' => function($model){
                                return $model->namaKelas->nama_kelas;
                            }
                        ],
                        [
                            'attribute' => 'waliKelas.id_wali_kelas',
                            'label' => 'Wali Kelas',
                            'value' => function($model){
                                return $model->waliKelas->pegawai->nama_pegawai;
                            }
                        ],
                        [
                            'attribute' => 'status',
                            'label' => 'Status',
                            'value' => function($model){
                                return ($model->status == 0) ? 'Non Active' : 'Active' ;
                            }
                        ],
                        [
                            'attribute' => 'tahunAjaran.tahun_ajaran',
                            'label' => 'Tahun Ajaran',
                            'value' => function($model){
                                return $model->tahunAjaran->tahun_ajaran;
                            }
                        ],
                    ];
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => $gridColumn,
                    ]);
                    ?>
                    <!-- </div> -->

                    <div class="pt-3">
                        <?php
                        if ($providerAbsensi->totalCount) {
                            $gridColumnAbsensi = [
                                ['class' => 'yii\grid\SerialColumn'],
                                'id_absensi',
                                ['attribute' => 'id_kelas', 'visible' => false],
                                'tanggal_efektif',
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
                    <div class="pt-3">
                        <?php
                        if ($providerOnKelasSiswa->totalCount) {
                            $gridColumnOnKelasSiswa = [
                                ['class' => 'yii\grid\SerialColumn'],
                                ['attribute' => 'id_kelas', 'visible' => false],
                                [
                                    'attribute' => 'siswa.id_siswa',
                                    'label' => 'Siswa',
                                    'value' => function($model){
                                        return $model->siswa->nama_siswa;
                                    }
                                ],
                            ];
                            echo Gridview::widget([
                                'dataProvider' => $providerOnKelasSiswa,
                                'pjax' => true,
                                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-on-kelas-siswa']],
                                'panel' => [
                                    //'type' => GridView::TYPE_PRIMARY,
                                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Daftar Siswa'),
                                ],
                                'export' => false,
                                'columns' => $gridColumnOnKelasSiswa,
                            ]);
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>