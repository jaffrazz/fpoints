<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="siswa-form">

    <?php $form = ActiveForm::begin(
        ['options' => ['enctype' => 'multipart/form-data']]
    ); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id_siswa', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'nis')->textInput(['maxlength' => true, 'placeholder' => 'NIS']) ?>

    <?= $form->field($model, 'nama_siswa')->textInput(['maxlength' => true, 'placeholder' => 'Nama']) ?>

    <?= $form->field($model, 'tempat_lahir_siswa')->textInput(['maxlength' => true, 'placeholder' => 'Tempat Lahir']) ?>

    <?= $form->field($model, 'tanggal_lahir_siswa')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => 'Pilih Tanggal Lahir',
                'autoclose' => true
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'jenis_kelamin_siswa')->dropDownList([ 'L' => 'Laki-laki', 'P' => 'Perempuan', ], ['prompt' => 'Pilih Jenis Kelamin']) ?>

    <?= $form->field($model, 'alamat_rumah_siswa')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'alamat_domisili_siswa')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'id_agama')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Agama::find()->orderBy('id_agama')->asArray()->all(), 'id_agama', 'agama'),
        'options' => ['placeholder' => 'Pilih Agama'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($modelOnKelas, 'id_kelas')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(
            \common\models\Kelas::find()->joinWith('namaKelas')->orderBy('nama_kelas.nama_kelas')->asArray()->all(), 
            'id_kelas', 
            'namaKelas.nama_kelas'),
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'no_hp_siswa')->widget(PhoneInput::className(),[
        'jsOptions' => [
            'preferredCountries' => ['id'],
        ]
    ]) ?>

    <?= $form->field($model, 'id_wali_murid')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\WaliMurid::find()->orderBy('id_wali_murid')->asArray()->all(), 'id_wali_murid', 'nama_wali_murid'),
        'options' => ['placeholder' => 'Pilih Wali murid'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'photo')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
        ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
