<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KelasSearch */
/* @var $form yii\widgets\ActiveForm */

$grade = [
    'x' => 'X',
    'xi' => 'XI',
    'xii' => 'XII',
    'xiii' => 'XIII',
];

?>

<div class="form-kelas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_kelas', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'id_jurusan')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Jurusan::find()->orderBy('id_jurusan')->asArray()->all(), 'id_jurusan', 'jurusan'),
        'options' => ['placeholder' => 'Pilih Jurusan'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'grade')->DropdownList($grade,[
        'prompt' => 'Pilih Grade'
    ]) ?>

    <?= $form->field($model, 'kelas')->textInput(['maxlength' => true, 'placeholder' => 'Kelas']) ?>


    <?= $form->field($model, 'id_tahun_ajaran')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\TahunAjaran::find()->orderBy('tahun_ajaran')->asArray()->all(), 'id_tahun_ajaran', 'tahun_ajaran'),
        'options' => ['placeholder' => 'Pilih Tahun Ajaran'],
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
