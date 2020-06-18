<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PrestasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-prestasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tanggal')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Pilih Tanggal',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'id_prestasi', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'id_siswa')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Siswa::find()->orderBy('id_siswa')->asArray()->all(), 'id_siswa', 'nama_siswa'),
        'options' => ['placeholder' => 'Pilih Siswa'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_penghargaan')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Penghargaan::find()->joinWith(['kategoriPenghargaan'])->orderBy('id_penghargaan')->asArray()->all(), 'id_penghargaan', 'uraian_penghargaan', 'kategoriPenghargaan.kategori_penghargaan'),
        'options' => ['placeholder' => 'Pilih Penghargaan'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
