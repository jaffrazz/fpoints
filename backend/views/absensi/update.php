<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Absensi */
$title = $model->tanggalEfektif->tanggal_efektif . ": " . $model->kelas->namaKelas->nama_kelas;
$title = explode(' ',$title);

if (count($title) > 4) {
    $title = implode(' ', array_slice($title, 0, 3)) . "...";
} else {
    $title = implode(' ', $title);
}

$this->title = 'Update Absensi: ' . ' ' . $title;
$this->params['breadcrumbs'][] = ['label' => 'Absensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['view', 'id' => $model->id_absensi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="absensi-update">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
