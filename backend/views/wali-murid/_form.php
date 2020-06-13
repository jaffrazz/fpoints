<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="wali-murid-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id_wali_murid', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'nama_wali_murid')->textInput(['maxlength' => true, 'placeholder' => 'Nama']) ?>

    <?= $form->field($model, 'alamat_rumah_wali_murid')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'tempat_lahir_wali_murid')->textInput(['maxlength' => true, 'placeholder' => 'Tempat Lahir']) ?>

    <?= $form->field($model, 'tanggal_lahir_wali_murid')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Plih Tanggal Lahir',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'jenis_kelamin_wali_murid')->dropDownList([ 'L' => 'Laki-laki', 'P' => 'Perempuan', ], ['prompt' => 'Pilih Jenis Kelamin']) ?>
    
    <?= $form->field($model, 'id_pekerjaan')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Pekerjaan::find()->orderBy('id_pekerjaan')->asArray()->all(), 'id_pekerjaan', 'nama_pekerjaan'),
        'options' => ['placeholder' => 'Pilih Pekerjaan'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_agama')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Agama::find()->orderBy('id_agama')->asArray()->all(), 'id_agama', 'agama'),
        'options' => ['placeholder' => 'Pilih Agama'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'no_hp_wali_murid')->textInput(['maxlength' => true, 'placeholder' => 'No HP']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
