<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AturanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-aturan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_aturan', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'id_kategori')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\KategoriAturan::find()->orderBy('id_kategori')->asArray()->all(), 'id_kategori', 'kategori_aturan'),
        'options' => ['placeholder' => 'Choose Kategori aturan'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_tindakan')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Tindakan::find()->orderBy('id_tindakan')->asArray()->all(), 'id_tindakan', 'tindakan'),
        'options' => ['placeholder' => 'Choose Tindakan'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'pasal')->textInput(['maxlength' => true, 'placeholder' => 'Pasal']) ?>

    <?= $form->field($model, 'uraian_aturan')->textarea(['rows' => 6]) ?>

    <?php /* echo $form->field($model, 'point_aturan')->textInput(['placeholder' => 'Point Aturan']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
