<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Aturan */

$this->title = $model->pasal;
$this->params['breadcrumbs'][] = ['label' => 'Aturan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aturan-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">

                    <?=Html::a('Update', ['update', 'id' => $model->id_aturan], ['class' => 'btn btn-primary'])?>
                    <?=Html::a('Delete', ['delete', 'id' => $model->id_aturan], [
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
                            ['attribute' => 'id_aturan', 'visible' => false],
                            [
                                'attribute' => 'kategori.kategori_aturan',
                                'label' => 'Kategori',
                            ],
                            'pasal',
                            'uraian_aturan:ntext',
                            'point_aturan',
                            [
                                'attribute' => 'tindakan.tindakan',
                                'label' => 'Tindakan',
                            ],
                            [
                                'attribute' => 'history_of_the_month',
                                'label' => 'Riwayat Pelanggaran Bulan Ini',
                                'value' => function() use($totalInThisMonth) {
                                    return $totalInThisMonth . " Kali";
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
                            if ($providerPelanggaran->totalCount) {
                                $gridColumnPelanggaran = [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'attribute' => 'siswa.id_siswa',
                                        'label' => 'Siswa',
                                        'value' => function($model){
                                            return $model->siswa->nama_siswa;
                                        }
                                    ],
                                    ['attribute' => 'id_aturan', 'visible' => false],
                                    'tanggal',
                                ];
                                echo Gridview::widget([
                                    'dataProvider' => $providerPelanggaran,
                                    'pjax' => true,
                                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-pelanggaran']],
                                    'panel' => [
                                        //'type' => GridView::TYPE_PRIMARY,
                                        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('5 Pelanggaran Terbaru'),
                                    ],
                                    'export' => false,
                                    'columns' => $gridColumnPelanggaran,
                                ]);
                            }
                            ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>