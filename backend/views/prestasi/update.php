<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Prestasi */

$title = $model->siswa->nama_siswa. ': '.$model->penghargaan->uraian_penghargaan;
$title = explode(' ',$title);

if(count($title) > 5){
    $title = implode(' ',array_slice($title, 0, 4)). "...";
}else{
    $title = implode(' ',$title);
}

$this->title = 'Update Prestasi: ' . ' ' . $title;
$this->params['breadcrumbs'][] = ['label' => 'Prestasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['view', 'id' => $model->id_prestasi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prestasi-update">
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
