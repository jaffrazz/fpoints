<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\KategoriPenghargaan */

$arr = explode(' ', $model->kategori_penghargaan);
if (count($arr) > 4) {
    $title = implode(' ', array_slice($arr, 0, 3)) . "...";
} else {
    $title = implode(' ', $arr);
}

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => 'Kategori Penghargaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-penghargaan-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">

                    <?=Html::a('Update', ['update', 'id' => $model->id_kategori_penghargaan], ['class' => 'btn btn-primary'])?>
                    <?=Html::a('Delete', ['delete', 'id' => $model->id_kategori_penghargaan], [
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
                            ['attribute' => 'id_kategori_penghargaan', 'visible' => false],
                            'kategori_penghargaan:ntext',
                        ];
                        echo DetailView::widget([
                            'model' => $model,
                            'attributes' => $gridColumn,
                        ]);
                        ?>
                    <!-- </div> -->

                    <div class="pt-3">
                        <?php
                        if ($providerPenghargaan->totalCount) {
                            $gridColumnPenghargaan = [
                                ['class' => 'yii\grid\SerialColumn'],
                                ['attribute' => 'id_kategori_penghargaan', 'visible' => false],
                                'uraian_penghargaan:ntext',
                                'point_penghargaan',
                            ];
                            echo Gridview::widget([
                                'dataProvider' => $providerPenghargaan,
                                'pjax' => true,
                                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-penghargaan']],
                                'panel' => [
                                    //'type' => GridView::TYPE_PRIMARY,
                                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Penghargaan'),
                                ],
                                'export' => false,
                                'columns' => $gridColumnPenghargaan,
                            ]);
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>