<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Penghargaan */


$title = explode(' ', $model->uraian_penghargaan);

if (count($title) > 4) {
    $title = implode(' ', array_slice($title, 0, 3)) . "...";
} else {
    $title = implode(' ', $title);
}


$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => 'Penghargaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penghargaan-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">

                    <?=Html::a('Update', ['update', 'id' => $model->id_penghargaan], ['class' => 'btn btn-primary'])?>
                    <?=Html::a('Delete', ['delete', 'id' => $model->id_penghargaan], [
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
                            ['attribute' => 'id_penghargaan', 'visible' => false],
                            [
                                'attribute' => 'kategoriPenghargaan.kategori_penghargaan',
                                'label' => 'Kategori Penghargaan',
                            ],
                            'pasal',
                            'point_penghargaan',
                            'uraian_penghargaan:ntext',
                            [
                                'attribute' => 'jumlah_peraih_bulan_ini',
                                'value' => function() use($totalInThisMonth){
                                    return $totalInThisMonth. " Kali";
                                }
                            ],
                        ];
                        echo DetailView::widget([
                            'model' => $model,
                            'attributes' => $gridColumn,
                        ]);
                        ?>

                    <div class="pt-3">
                        <?php
                            if ($providerPrestasi->totalCount) {
                                $gridColumnPrestasi = [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'tanggal',
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
                                    ['attribute' => 'id_penghargaan', 'visible' => false],
                                ];
                                echo Gridview::widget([
                                    'dataProvider' => $providerPrestasi,
                                    'pjax' => true,
                                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-prestasi']],
                                    'panel' => [
                                        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('5 Peraih Prestasi Terbaru'),
                                    ],
                                    'export' => false,
                                    'columns' => $gridColumnPrestasi,
                                ]);
                            }
                            ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>