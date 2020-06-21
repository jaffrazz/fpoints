<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AkumulasiPoint */

$this->title = 'Create Akumulasi Point';
$this->params['breadcrumbs'][] = ['label' => 'Akumulasi Point', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akumulasi-point-create">
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
