<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Prestasi */
/* @var $form yii\widgets\ActiveForm */


$id_kelas = $model->isNewRecord 
    ? null 
    : $model->siswa->onKelasSiswa->id_kelas;

?>


<div class="prestasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>


    <?= '<label class="control-label">Kelas</label>'; ?>
    <?= \kartik\widgets\Select2::widget([
        'name' => 'id_kelas',
        'data' => \yii\helpers\ArrayHelper::map(
            \common\models\Kelas::find()
                ->joinWith(['namaKelas'])
                ->where(['status' => 1])
                ->orderBy('nama_kelas')
                ->asArray()
                ->all(), 
            'id_kelas', 
            'namaKelas.nama_kelas'),
        'value' => $id_kelas,
        'options' => 
            ['id' => 'id_kelas', 'placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'id_prestasi', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'id_siswa')->widget(\kartik\widgets\DepDrop::classname(), [
        'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'options'=>['id'=>'id_siswa'],
        'pluginOptions'=>[
            'depends'=>['id_kelas'],
            'initialize' => $model->isNewRecord ? false : true,
            'placeholder'=>'Pilih Siswa...',
            'url'=>\yii\helpers\Url::to(['/v9/siswa'])
        ]
    ]); ?>

    <?= $form->field($model, 'id_penghargaan')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Penghargaan::find()->orderBy('id_penghargaan')->joinWith('kategoriPenghargaan')->asArray()->all(), 'id_penghargaan', 'uraian_penghargaan','kategoriPenghargaan.kategori_penghargaan'),
        'options' => ['placeholder' => 'Pilih Penghargaan'],
        'pluginOptions' => [
            'allowClear' => true
        ],
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

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
