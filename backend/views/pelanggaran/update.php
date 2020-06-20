<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pelanggaran */

$title = $model->siswa->nama_siswa . ': ' . $model->aturan->uraian_aturan;
$title = explode(' ', $title);

if (count($title) > 5) {
    $title = implode(' ', array_slice($title, 0, 4)) . "...";
} else {
    $title = implode(' ', $title);
}

$this->title = 'Update Pelanggaran: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pelanggaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id_pelanggaran]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pelanggaran-update">
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
