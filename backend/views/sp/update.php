<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sp */

$this->title = 'Update Sp: ' . ' ' . $model->id_sp;
$this->params['breadcrumbs'][] = ['label' => 'Sp', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sp, 'url' => ['view', 'id' => $model->id_sp]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
