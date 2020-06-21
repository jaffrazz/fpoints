<div class="form-group" id="add-detail-akumulasi-point">
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
    'formName' => 'DetailAkumulasiPoint',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        'id_detail_akumulasi_point' => ['type' => TabularForm::INPUT_HIDDEN],
        'id_siswa' => [
            'label' => 'Siswa',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\Siswa::find()->orderBy('id_siswa')->asArray()->all(), 'id_siswa', 'id_siswa'),
                'options' => ['placeholder' => 'Choose Siswa'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'point_pelanggaran' => ['type' => TabularForm::INPUT_TEXT],
        'point_penghargaan' => ['type' => TabularForm::INPUT_TEXT],
        'id_sanksi' => [
            'label' => 'Sanksi',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\Sanksi::find()->orderBy('id_sanksi')->asArray()->all(), 'id_sanksi', 'id_sanksi'),
                'options' => ['placeholder' => 'Choose Sanksi'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowDetailAkumulasiPoint(' . $key . '); return false;', 'id' => 'detail-akumulasi-point-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Detail Akumulasi Point', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowDetailAkumulasiPoint()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

