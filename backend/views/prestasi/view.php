<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Prestasi */

$this->title = $model->id_prestasi;
$this->params['breadcrumbs'][] = ['label' => 'Prestasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prestasi-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">

                    <?=Html::a('Update', ['update', 'id' => $model->id_prestasi], ['class' => 'btn btn-primary'])?>
                    <?=Html::a('Delete', ['delete', 'id' => $model->id_prestasi], [
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
                        ['attribute' => 'id_prestasi', 'visible' => false],
                        [
                            'attribute' => 'siswa.id_siswa',
                            'label' => 'Id Siswa',
                        ],
                        [
                            'attribute' => 'penghargaan.id_penghargaan',
                            'label' => 'Id Penghargaan',
                        ],
                        'tanggal',
                    ];
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => $gridColumn,
                    ]);
                    ?>
                    <!-- </div> -->
                    <div class="pt-3">
                        <h3><b>Siswa<?=' ' . Html::encode($this->title)?></b></h3>
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
                        'attributes' => $gridColumnSiswa]);
                    ?>
                    <div class="pt-3">
                        <h3><b>Penghargaan<?=' ' . Html::encode($this->title)?></b></h3>
                    </div>
                    <?php
                    $gridColumnPenghargaan = [
                        'id_kategori_penghargaan',
                        'uraian_penghargaan',
                        'point_penghargaan',
                        'pasal',
                    ];
                    echo DetailView::widget([
                        'model' => $model->penghargaan,
                        'attributes' => $gridColumnPenghargaan]);
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
