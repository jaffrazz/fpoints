<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HariTidakEfektif */
$title = $model->keterangan_tidak_efektif;
$title = explode(' ',$title);

if(count($title) > 5){
    $title = implode(' ',array_slice($title,0,4)). '...';
}else{
    $title = implode(' ',$title);
}

$this->title = 'Update Hari Tidak Efektif: ' . ' ' . $title;
$this->params['breadcrumbs'][] = ['label' => 'Hari Tidak Efektif', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['view', 'id' => $model->id_hari_tidak_efektif]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hari-tidak-efektif-update">
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
