<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'OnKelasSiswa', 
        'relID' => 'on-kelas-siswa', 
        'value' => \yii\helpers\Json::encode($model->onKelasSiswas),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id_kelas', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'id_jurusan')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Jurusan::find()->orderBy('id_jurusan')->asArray()->all(), 'id_jurusan', 'jurusan'),
        'options' => ['placeholder' => 'Pilih Jurusan'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_wali_kelas')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(
            \common\models\WaliKelas::find()
                ->joinWith('pegawai')
                ->where(['not in','pegawai.id_pegawai',
                    \common\models\WaliKelas::find()
                        ->joinWith(['kelas'])
                        ->where(['kelas.status' => 1])
                        ->select('id_pegawai')
                ])
                ->orderBy('id_wali_kelas')
                ->asArray()
                ->all(), 
            'id_wali_kelas', 
            'pegawai.nama_pegawai'),
        'options' => ['placeholder' => 'Pilih Wali kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'kelas')->textInput(['maxlength' => true, 'placeholder' => 'Kelas']) ?>

    <?= $form->field($model, 'grade')->textInput(['maxlength' => true, 'placeholder' => 'Grade']) ?>

    <?= $form->field($model, 'id_tahun_ajaran')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\TahunAjaran::find()->orderBy('id_tahun_ajaran')->asArray()->all(), 'id_tahun_ajaran', 'tahun_ajaran'),
        'options' => ['placeholder' => 'Pilih Tahun ajaran'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('Daftar Siswa'),
            'content' => $this->render('_formOnKelasSiswa', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->onKelasSiswas),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
