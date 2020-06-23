<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model common\models\Prestasi */

$this->title = $model->id_prestasi;
$this->params['breadcrumbs'][] = ['label' => 'Prestasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestasi-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <?php if(Helper::checkRoute('Update')){
                        echo Html::a('Update', ['update', 'id' => $model->id_absensi], ['class' => 'btn btn-primary']);
                    } ?>
                    <?php if(Helper::checkRoute('Update')){
                        echo Html::a('Delete', ['delete', 'id' => $model->id_absensi], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]);
                    } ?>
                </div>
                <div class="box-body">
                    <!-- <div class="row"> -->
                    <?php
                    $gridColumn = [
                        ['attribute' => 'id_prestasi', 'visible' => false],
                        [
                            'attribute' => 'siswa.id_siswa',
                            'label' => 'Siswa',
                            'value' => function($model){
                                return $model->siswa->nama_siswa;
                            }
                        ],
                        [
                            'attribute' => 'siswa.id_kelas',
                            'label' => 'Kelas',
                            'value' => function($model){
                                return $model->siswa->onKelasSiswa->kelas->namaKelas->nama_kelas;
                            }
                        ],
                        [
                            'attribute' => 'penghargaan.id_kategori_penghargaan',
                            'label' => 'Jenis Penghargaan',
                            'value' => function($model){
                                return $model->penghargaan->kategoriPenghargaan->kategori_penghargaan;
                            }
                        ],
                        [
                            'attribute' => 'penghargaan.id__penghargaan',
                            'label' => 'Penghargaan Atas',
                            'value' => function($model){
                                return $model->penghargaan->uraian_penghargaan;
                            }
                        ],
                        [
                            'attribute' => 'penghargaan.point',
                            'label' => 'Jumlah Point',
                            'value' => function($model){
                                return $model->penghargaan->point_penghargaan. " Point";
                            }
                        ],
                        'tanggal',
                    ];
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => $gridColumn,
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
