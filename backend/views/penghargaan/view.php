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
                                    [
                                        'attribute' => 'siswa.id_siswa',
                                        'label' => 'Siswa',
                                        'value' => function($model){
                                            return $model->siswa->nam_siswa;
                                        }
                                    ],
                                    ['attribute' => 'id_penghargaan', 'visible' => false],
                                    'tanggal',
                                ];
                                echo Gridview::widget([
                                    'dataProvider' => $providerPrestasi,
                                    'pjax' => true,
                                    'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-prestasi']],
                                    'panel' => [
                                        //'type' => GridView::TYPE_PRIMARY,
                                        'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Peraih Prestasi'),
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