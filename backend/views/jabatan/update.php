<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Jabatan */

$this->title = 'Update Jabatan: ' . ' ' . $model->jabatan;
$this->params['breadcrumbs'][] = ['label' => 'Jabatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jabatan, 'url' => ['view', 'id' => $model->id_jabatan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jabatan-update">
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
