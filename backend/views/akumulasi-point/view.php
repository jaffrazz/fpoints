<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AkumulasiPoint */

$title = $model->tahunAjaran->tahun_ajaran . " semester " . $model->semester->id_semester;

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => 'Akumulasi Point', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akumulasi-point-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">

                    <?=Html::a('Update', ['update', 'id' => $model->id_akumulasi_point], ['class' => 'btn btn-primary'])?>
                    <?=Html::a('Delete', ['delete', 'id' => $model->id_akumulasi_point], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </div>
                <div class="box-body">
                    <?php
                    $gridColumn = [
                        ['attribute' => 'id_akumulasi_point', 'visible' => false],
                        [
                            'attribute' => 'tahunAjaran.tahun_ajaran',
                            'label' => 'Tahun Ajaran',
                        ],
                        [
                            'attribute' => 'semester.semester',
                            'label' => 'Semester',
                        ],
                    ];
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => $gridColumn,
                    ]);
                    ?>

                    <div class="pt-3">
                        <?php
                        if ($providerDetailAkumulasiPoint->totalCount) {
                            $gridColumnDetailAkumulasiPoint = [
                                ['class' => 'yii\grid\SerialColumn'],
                                ['attribute' => 'id_detail_akumulasi_point', 'visible' => false],
                                ['attribute' => 'id_akumulasi_point', 'visible' => false],
                                [
                                    'attribute' => 'id_kelas',
                                    'label' => 'Kelas',
                                    'value' => function($model){
                                        return $model->siswa->onKelasSiswa->kelas->namaKelas->nama_kelas;
                                    }
                                ],
                                [
                                    'attribute' => 'siswa.id_siswa',
                                    'label' => 'Siswa',
                                    'value' => function($model){
                                        return $model->siswa->nama_siswa;
                                    }
                                ],
                                'point_pelanggaran',
                                'point_penghargaan',
                                [
                                    'attribute' => 'sanksi.id_sanksi',
                                    'label' => 'Sanksi',
                                    'value' => function($model){
                                        return $model->sanksi->uraian;
                                    }
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
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>