<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model SpSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-sp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_sp')->textInput(['placeholder' => 'Id Sp']) ?>

    <?= $form->field($model, 'id_siswa')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Siswa::find()->orderBy('id_siswa')->asArray()->all(), 'id_siswa', 'id_siswa'),
        'options' => ['placeholder' => 'Choose Siswa'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'sp_ke')->textInput(['maxlength' => true, 'placeholder' => 'Sp Ke']) ?>

    <?= $form->field($model, 'tanggal_sp')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Choose Tanggal Sp',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'jml_point_pelanggaran')->textInput(['placeholder' => 'Jml Point Pelanggaran']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
