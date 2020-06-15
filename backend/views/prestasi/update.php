<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Prestasi */

$this->title = 'Update Prestasi: ' . ' ' . $model->id_prestasi;
$this->params['breadcrumbs'][] = ['label' => 'Prestasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_prestasi, 'url' => ['view', 'id' => $model->id_prestasi]];
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
