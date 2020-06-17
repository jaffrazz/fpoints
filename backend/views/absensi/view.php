<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Absensi */

$title = $model->tanggalEfektif->tanggal_efektif . ": ". $model->kelas->namaKelas->nama_kelas;
$title = explode(' ', $title);

if (count($title) > 4) {
    $title = implode(' ', array_slice($title, 0, 3)) . "...";
} else {
    $title = implode(' ', $title);
}

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => 'Absensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="absensi-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">

                    <?=Html::a('Update', ['update', 'id' => $model->id_absensi], ['class' => 'btn btn-primary'])?>
                    <?=Html::a('Delete', ['delete', 'id' => $model->id_absensi], [
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
                        ['attribute' => 'id_absensi', 'visible' => false],
                        [
                            'attribute' => 'kelas.kelas',
                            'label' => 'Kelas',
                            'value' => function($model){
                                return $model->kelas->namaKelas->nama_kelas;
                            }
                        ],
                        [
                            'attribute' => 'tanggalEfektif.tanggal_efektif',
                            'label' => 'Tanggal Efektif',
                            'value' => function($model){
                                return $model->tanggalEfektif->tanggal_efektif;
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
                        if ($providerDetailAbsensi->totalCount) {
                            $gridColumnDetailAbsensi = [
                                ['class' => 'yii\grid\SerialColumn'],
                                ['attribute' => 'id_absensi', 'visible' => false],
                                [
                                    'attribute' => 'siswa.id_siswa',
                                    'label' => 'Siswa',
                                    'value' => function($model) {
                                        return $model->siswa->nama_siswa;
                                    }
                                ],
                                [
                                    'attribute' => 'statusAbsensi.id_status_absensi',
                                    'label' => 'Status Absensi',
                                    'value' => function($model) {
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
                                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Detail Absensi'),
                                ],
                                'export' => false,
                                'columns' => $gridColumnDetailAbsensi,
                            ]);
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>