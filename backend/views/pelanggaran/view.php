<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Pelanggaran */

$this->title = $model->id_pelanggaran;
$this->params['breadcrumbs'][] = ['label' => 'Pelanggaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelanggaran-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                                                                    
                            <?= Html::a('Update', ['update', 'id' => $model->id_pelanggaran], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Delete', ['delete', 'id' => $model->id_pelanggaran], [
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
                        ['attribute' => 'id_pelanggaran', 'visible' => false],
        [
            'attribute' => 'siswa.id_siswa',
            'label' => 'Id Siswa',
        ],
        [
            'attribute' => 'aturan.id_aturan',
            'label' => 'Id Aturan',
        ],
        'tanggal',
                    ];
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => $gridColumn
                    ]);
                ?>
                    <!-- </div> -->
                                                    <div class="pt-3">
                        <h3><b>Siswa<?= ' '. Html::encode($this->title) ?></b></h3>
                    </div>
                    <?php 
                    $gridColumnSiswa = [
                            'id_wali_murid',
        'id_agama',
        'nis',
        'nama_siswa',
        'tempat_lahir_siswa',
        'tanggal_lahir_siswa',
        'jenis_kelamin_siswa',
        'alamat_rumah_siswa',
        'alamat_domisili_siswa',
        'no_hp_siswa',
        'foto_siswa',
                        ];
                        echo DetailView::widget([
                            'model' => $model->siswa,
                            'attributes' => $gridColumnSiswa                        ]);
                        ?>
                                                                            <div class="pt-3">
                        <h3><b>Aturan<?= ' '. Html::encode($this->title) ?></b></h3>
                    </div>
                    <?php 
                    $gridColumnAturan = [
                            'id_kategori',
        'id_tindakan',
        'pasal',
        'uraian_aturan',
        'point_aturan',
                        ];
                        echo DetailView::widget([
                            'model' => $model->aturan,
                            'attributes' => $gridColumnAturan                        ]);
                        ?>
                                                        </div>
            </div>
        </div>
    </div>

</div>
