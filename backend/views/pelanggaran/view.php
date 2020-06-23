<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model common\models\Pelanggaran */

$this->title = $model->id_pelanggaran;
$this->params['breadcrumbs'][] = ['label' => 'Pelanggaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelanggaran-view">

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
                        ['attribute' => 'id_pelanggaran', 'visible' => false],
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
                            'attribute' => 'aturan.id_kategori_aturan',
                            'label' => 'Jenis Pelanggaran',
                            'value' => function($model){
                                return $model->aturan->kategori->kategori_aturan;
                            }
                        ],
                        [
                            'attribute' => 'aturan.pasal',
                            'label' => 'Pasal',
                            'value' => function($model){
                                return $model->aturan->pasal;
                            }
                        ],
                        [
                            'attribute' => 'aturan.id_aturan',
                            'label' => 'Uraian Aturan',
                            'value' => function($model){
                                return $model->aturan->uraian_aturan;
                            }
                        ],
                        [
                            'attribute' => 'aturan.point',
                            'label' => 'Jumlah Point',
                            'value' => function($model){
                                return $model->aturan->point_aturan. " Point";
                            }
                        ],
                        [
                            'attribute' => 'aturan.tindakan',
                            'label' => 'Tindakan',
                            'value' => function($model){
                                return $model->aturan->tindakan->tindakan;
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