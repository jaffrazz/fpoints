<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use kartik\select2\Select2;

?>

<div class="pegawai-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id_pegawai', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>


    <?= $form->field($model, 'nama_pegawai')->textInput(['maxlength' => true, 'placeholder' => 'Nama Pegawai']) ?>

    <?= $form->field($model, 'alamat_pegawai')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'jenis_kelamin_pegawai')->dropDownList([ 'L' => 'Laki-laki', 'P' => 'Perempuan', ], ['prompt' => 'Pilih jenis Kelamin']) ?>

    <?= $form->field($model, 'id_agama')->widget(Select2::classname(), [
            'data' => $agama,
            'options' => ['placeholder' => 'Pilih Agama ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <?= $form->field($model, 'no_hp_pegawai')->widget(PhoneInput::className(),[
        'jsOptions' => [
            'preferredCountries' => ['id'],
        ]
    ]) ?>

    <?= $form->field($model, 'status_kepegawaian')->dropDownList($status_kepegawaian, ['prompt' => 'Status Kepegawaian']) ?>

    <?= $form->field($model, 'jabatan_pegawai')->widget(Select2::classname(), [
            'data' => $jabatan,
            'options' => ['placeholder' => 'Pilih Jabatan ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <?= $form->field($model, 'foto_pegawai')->textInput(['maxlength' => true, 'placeholder' => 'Foto Pegawai']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
