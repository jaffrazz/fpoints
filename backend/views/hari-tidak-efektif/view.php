<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HariTidakEfektif */

$title = $model->keterangan_tidak_efektif;
$title = explode(' ',$title);

if(count($title) > 5){
    $title = implode(' ',array_slice($title,0,4)). '...';
}else{
    $title = implode(' ',$title);
}


$this->title = $title;

$this->params['breadcrumbs'][] = ['label' => 'Hari Tidak Efektif', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hari-tidak-efektif-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <?=Html::a('Update', ['update', 'id' => $model->id_hari_tidak_efektif], ['class' => 'btn btn-primary'])?>
                    <?=Html::a('Delete', ['delete', 'id' => $model->id_hari_tidak_efektif], [
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
                        ['attribute' => 'id_hari_tidak_efektif', 'visible' => false],
                        'tanggal_awal',
                        [
                            'attribute' => 'tanggal_akhir',
                            'value' => function($model){
                                return ($model->tanggal_akhir != null) ? $model->tanggal_akhir : "-";
                            }
                        ],
                        'keterangan_tidak_efektif:ntext',
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