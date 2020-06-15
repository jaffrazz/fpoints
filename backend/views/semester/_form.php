<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Semester */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="semester-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id_semester',['template' => '{input}'])->textInput(['type' => 'hidden']) ?>

    <?= $form->field($model, 'semester')->dropDownList([ 1 => '1', 2 => '2', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'awal_bulan_semester')->dropDownList($bulan, ['prompt' => 'Pilih Bulan']) ?>

    <?= $form->field($model, 'akhir_bulan_semester')->dropDownList($bulan, ['prompt' => 'Pilih Bulan']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
