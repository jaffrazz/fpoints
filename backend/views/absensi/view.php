<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Absensi */

$this->title = $model->id_absensi;
$this->params['breadcrumbs'][] = ['label' => 'Absensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="absensi-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">

                    <?=Html::a('Update', ['update', 'id' => $model->id_absensi], ['class' => 'btn btn-primary'])?>
                    <?=Html::a('Delete', ['delete', 'id' => $model->id_absensi], [
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
                        ['attribute' => 'id_absensi', 'visible' => false],
                        [
                            'attribute' => 'siswa.id_siswa',
                            'label' => 'Id Siswa',
                        ],
                        [
                            'attribute' => 'statusAbsensi.id_status_absensi',
                            'label' => 'Id Status Absensi',
                        ],
                        [
                            'attribute' => 'tanggalEfektif.tanggal_efektif',
                            'label' => 'Id Tanggal Efektif',
                        ],
                        'keterangan:ntext',
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
                        <h3><b>StatusAbsensi<?=' ' . Html::encode($this->title)?></b></h3>
                    </div>
                    <?php
                    $gridColumnStatusAbsensi = [
                        'keterangan_status_absensi',
                    ];
                    echo DetailView::widget([
                        'model' => $model->statusAbsensi,
                        'attributes' => $gridColumnStatusAbsensi]);
                    ?>
                    <div class="pt-3">
                        <h3><b>TanggalEfektif<?=' ' . Html::encode($this->title)?></b></h3>
                    </div>
                    <?php
                    $gridColumnTanggalEfektif = [
                        'tanggal_efektif',
                    ];
                    echo DetailView::widget([
                        'model' => $model->tanggalEfektif,
                        'attributes' => $gridColumnTanggalEfektif]);
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>