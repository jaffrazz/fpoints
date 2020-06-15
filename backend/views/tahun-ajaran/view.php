<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\TahunAjaran */

$this->title = $model->tahun_ajaran;
$this->params['breadcrumbs'][] = ['label' => 'Tahun Ajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tahun-ajaran-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                                                                    
                            <?= Html::a('Update', ['update', 'id' => $model->id_tahun_ajaran], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Delete', ['delete', 'id' => $model->id_tahun_ajaran], [
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
                        ['attribute' => 'id_tahun_ajaran', 'visible' => false],
        'tahun_ajaran',
                    ];
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => $gridColumn
                    ]);
                ?>
                    <!-- </div> -->
                                
                    <div class="pt-3">
                        <?php
                        if($providerAkumulasiPoint->totalCount){
                            $gridColumnAkumulasiPoint = [
                                ['class' => 'yii\grid\SerialColumn'],
                                    [
                'attribute' => 'siswa.id_siswa',
                'label' => 'Id Siswa'
            ],
            [
                'attribute' => 'sanksi.id_sanksi',
                'label' => 'Id Sanksi'
            ],
            'total_point',
            'tanggal',
            ['attribute' => 'id_tahun_ajaran', 'visible' => false],
            [
                'attribute' => 'semester.semester',
                'label' => 'Id Semester'
            ],
                            ];
                            echo Gridview::widget([
                                'dataProvider' => $providerAkumulasiPoint,
                                'pjax' => true,
                                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-akumulasi-point']],
                                'panel' => [
                                    //'type' => GridView::TYPE_PRIMARY,
                                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Akumulasi Point'),
                                ],
                                                        'export' => false,
                                                        'columns' => $gridColumnAkumulasiPoint
                            ]);
                        }
                        ?>

                    </div>
                                                        
                    <div class="pt-3">
                        <?php
                        if($providerKelas->totalCount){
                            $gridColumnKelas = [
                                ['class' => 'yii\grid\SerialColumn'],
                                    'id_kelas',
            [
                'attribute' => 'jurusan.jurusan',
                'label' => 'Id Jurusan'
            ],
            [
                'attribute' => 'waliKelas.id_wali_kelas',
                'label' => 'Id Wali Kelas'
            ],
            'kelas',
            'grade',
            ['attribute' => 'id_tahun_ajaran', 'visible' => false],
                            ];
                            echo Gridview::widget([
                                'dataProvider' => $providerKelas,
                                'pjax' => true,
                                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-kelas']],
                                'panel' => [
                                    //'type' => GridView::TYPE_PRIMARY,
                                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Kelas'),
                                ],
                                                        'export' => false,
                                                        'columns' => $gridColumnKelas
                            ]);
                        }
                        ?>

                    </div>
                                                        </div>
            </div>
        </div>
    </div>

</div>
