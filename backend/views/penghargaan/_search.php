<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PenghargaanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-penghargaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_penghargaan', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'id_kategori_penghargaan')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\KategoriPenghargaan::find()->orderBy('id_kategori_penghargaan')->asArray()->all(), 'id_kategori_penghargaan', 'kategori_penghargaan'),
        'options' => ['placeholder' => 'Choose Kategori penghargaan'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'uraian_penghargaan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'point_penghargaan')->textInput(['placeholder' => 'Point Penghargaan']) ?>

    <?= $form->field($model, 'pasal')->textInput(['maxlength' => true, 'placeholder' => 'Pasal']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
