<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$js = "
$('#id_kategori').on('change',function(){
    let id = $('#id_kategori').children('option:selected').val();
    $.ajax('".Yii::$app->homeUrl."/aturan/get-pasal/?id='+id).then(res => {
        let val = JSON.parse(res)
        $('#pasal').val(val.pasal);
        $('#pasal').attr('readonly','true');
    });
});
";
if($model->isNewRecord) $this->registerJs($js);
?>

<div class="aturan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id_aturan', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?php /* echo $form->field($model, 'id_kategori')->DropdownList(
        \yii\helpers\ArrayHelper::map(\common\models\KategoriAturan::find()->orderBy('id_kategori')->asArray()->all(), 'id_kategori', 'kategori_aturan'),
        [
            'prompt' => 'Pilih kategori'
        ]
    ) */?>
    <?= $form->field($model, 'id_kategori')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\KategoriAturan::find()->orderBy('id_kategori')->asArray()->all(), 'id_kategori', 'kategori_aturan'),
        'options' => ($model->isNewRecord) ? ['placeholder' => 'Pilih Kategori aturan'] : ['placeholder' => 'Pilih Kategori aturan','disabled' => 'true'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'pasal')->textInput(['maxlength' => true, 'placeholder' => 'Pasal', 'readonly' => true]) ?>

    <?= $form->field($model, 'uraian_aturan')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'point_aturan')->textInput(['placeholder' => 'Point Aturan']) ?>

    <?= $form->field($model, 'id_tindakan')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Tindakan::find()->orderBy('id_tindakan')->asArray()->all(), 'id_tindakan', 'tindakan'),
        'options' => ['placeholder' => 'Pilih Tindakan'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>