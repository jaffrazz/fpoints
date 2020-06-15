<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pelanggaran */

$this->title = 'Update Pelanggaran: ' . ' ' . $model->id_pelanggaran;
$this->params['breadcrumbs'][] = ['label' => 'Pelanggaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pelanggaran, 'url' => ['view', 'id' => $model->id_pelanggaran]];
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
