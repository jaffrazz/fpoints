<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Agama */

$this->title = $model->agama;
$this->params['breadcrumbs'][] = ['label' => 'Agama', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agama-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <?= Html::a('Update', ['update', 'id' => $model->id_agama], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id_agama], [
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
                        ['attribute' => 'id_agama', 'visible' => false],
                        'agama',
                        [
                            'attribute' => 'jumlah_pegawai',
                            'value' => function() use ($providerPegawai) {
                                return $providerPegawai->totalCount . " Orang";
                            }
                        ],
                        [
                            'attribute' => 'jumlah_siswa',
                            'value' => function() use ($providerSiswa) {
                                return $providerSiswa->totalCount . " Orang";
                            }
                        ]
                    ];
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => $gridColumn
                    ]);
                    ?>    
                </div>
            </div>
        </div>
    </div>

</div>