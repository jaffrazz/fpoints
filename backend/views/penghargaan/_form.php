<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Penghargaan */
/* @var $form yii\widgets\ActiveForm */

$js = "
$('#id_kategori_penghargaan').on('change',function(){
    let id = $('#id_kategori_penghargaan').children('option:selected').val();
    $.ajax('" . Yii::$app->homeUrl . "/penghargaan/get-pasal/?id='+id).then(res => {
        let val = JSON.parse(res)
        $('#pasal').val(val.pasal);
        $('#pasal').attr('readonly','true');
    });
});
";
if ($model->isNewRecord) {
    $this->registerJs($js);
}

?>

<div class="penghargaan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id_penghargaan', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'id_kategori_penghargaan')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\KategoriPenghargaan::find()->orderBy('id_kategori_penghargaan')->asArray()->all(), 'id_kategori_penghargaan', 'kategori_penghargaan'),
        'options' => ['placeholder' => 'Pilih Kategori penghargaan'],
        'pluginOptions' => $model->isNewRecord ? [
            'allowClear' => true
        ] : [
            'allowClear' => false,
            'disabled' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'pasal')->textInput(['maxlength' => true, 'placeholder' => 'Pasal', 'readonly' => true]) ?>

    <?= $form->field($model, 'uraian_penghargaan')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'point_penghargaan')->textInput(['placeholder' => 'Point Penghargaan','type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
