<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Sp */

$this->title = $model->id_sp;
$this->params['breadcrumbs'][] = ['label' => 'Sp', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sp-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Sp'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->id_sp],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            
            <?= Html::a('Update', ['update', 'id' => $model->id_sp], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_sp], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'id_sp',
        [
            'attribute' => 'siswa.id_siswa',
            'label' => 'Id Siswa',
        ],
        'sp_ke',
        'tanggal_sp',
        'jml_point_pelanggaran',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Siswa<?= ' '. Html::encode($this->title) ?></h4>
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
        'attributes' => $gridColumnSiswa    ]);
    ?>
</div>
