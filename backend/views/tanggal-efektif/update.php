<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TanggalEfektif */

$this->title = 'Update Tanggal Efektif: ' . ' ' . $model->tanggal_efektif;
$this->params['breadcrumbs'][] = ['label' => 'Tanggal Efektif', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tanggal_efektif, 'url' => ['view', 'id' => $model->id_tanggal_efektif]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tanggal-efektif-update">
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
