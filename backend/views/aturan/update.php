<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Aturan */

$this->title = 'Update Aturan: ' . ' ' . $model->id_aturan;
$this->params['breadcrumbs'][] = ['label' => 'Aturan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_aturan, 'url' => ['view', 'id' => $model->id_aturan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aturan-update">
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
