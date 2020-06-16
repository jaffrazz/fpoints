<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\TanggalEfektif */

$this->title = $model->tanggal_efektif;
$this->params['breadcrumbs'][] = ['label' => 'Tanggal Efektif', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tanggal-efektif-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                                                                    
                            <?= Html::a('Update', ['update', 'id' => $model->id_tanggal_efektif], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Delete', ['delete', 'id' => $model->id_tanggal_efektif], [
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
                        ['attribute' => 'id_tanggal_efektif', 'visible' => false],
        'tanggal_efektif',
                    ];
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => $gridColumn
                    ]);
                ?>
                    <!-- </div> -->
                                
                    <div class="pt-3">
                        <?php
                        if($providerAbsensi->totalCount){
                            $gridColumnAbsensi = [
                                ['class' => 'yii\grid\SerialColumn'],
                                    'id_absensi',
            [
                'attribute' => 'siswa.id_siswa',
                'label' => 'Id Siswa'
            ],
            [
                'attribute' => 'statusAbsensi.id_status_absensi',
                'label' => 'Id Status Absensi'
            ],
            ['attribute' => 'id_tanggal_efektif', 'visible' => false],
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
                                                        'columns' => $gridColumnAbsensi
                            ]);
                        }
                        ?>

                    </div>
                                                        </div>
            </div>
        </div>
    </div>

</div>
