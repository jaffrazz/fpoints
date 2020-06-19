<div class="form-group" id="add-detail-absensi">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'DetailAbsensi',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        'id_detail_absensi' => [
            'type' => TabularForm::INPUT_HIDDEN,
            'columnOptions'=>['hidden'=>true]
        ],
        'id_siswa' => [
            'label' => 'Siswa',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\DepDrop::className(),
            'options' => [
                    'pluginOptions'=>[
                        'depends'=>['id_kelas'],
                        'placeholder'=>'Pilih Siswa...',
                        'url'=>\yii\helpers\Url::to(['/v9/siswa'])
                    ],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'id_status_absensi' => [
            'label' => 'Status absensi',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\StatusAbsensi::find()->orderBy('id_status_absensi')->asArray()->all(), 'id_status_absensi', 'keterangan_status_absensi'),
                'options' => ['placeholder' => 'Pilih Status absensi'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'keterangan' => ['type' => TabularForm::INPUT_TEXTAREA],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowDetailAbsensi(' . $key . '); return false;', 'id' => 'detail-absensi-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Detail Absensi', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowDetailAbsensi()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

