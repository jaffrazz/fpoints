<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AkumulasiPointSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-akumulasi-point-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_akumulasi_point', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'id_tahun_ajaran')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\TahunAjaran::find()->orderBy('id_tahun_ajaran')->asArray()->all(), 'id_tahun_ajaran', 'tahun_ajaran'),
        'options' => ['placeholder' => 'Choose Tahun ajaran'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_semester')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Semester::find()->orderBy('id_semester')->asArray()->all(), 'id_semester', 'semester'),
        'options' => ['placeholder' => 'Choose Semester'],
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
