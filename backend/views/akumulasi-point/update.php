<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AkumulasiPoint */

$this->title = 'Update Akumulasi Point: ' . ' ' . $model->id_akumulasi_point;
$this->params['breadcrumbs'][] = ['label' => 'Akumulasi Point', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_akumulasi_point, 'url' => ['view', 'id' => $model->id_akumulasi_point]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="akumulasi-point-update">
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
