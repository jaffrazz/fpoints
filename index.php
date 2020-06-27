<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Surat Peringatan';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="sp-index">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <div class="box-body">
                <?php 
                        $gridColumn = [
                ['class' => 'yii\grid\SerialColumn'],
                
                [
                'attribute' => 'id_siswa',
                'label' => 'Siswa',
                'value' => function($model){                   
                    return $model->siswa->nama_siswa;                   
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\Siswa::find()->asArray()->all(), 'id_siswa', 'nama_siswa'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Siswa', 'id' => 'grid--id_siswa']
                ],
		        'sp_ke',
		        'tanggal_sp',
		        'jml_point_pelanggaran',
                \backend\views\sp\ActionButton::getButtons(),
                        ];
                                            ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => $gridColumn,
                            'pjax' => true,
                            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-sp']],
                            'panel' => [
                                //'type' => GridView::TYPE_PRIMARY,
                                'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
                            ],
                                                'export' => false,
                                                // your toolbar can include the additional full export menu
                            'toolbar' => [
                                '{export}',
                                ExportMenu::widget([
                                    'dataProvider' => $dataProvider,
                                    'columns' => $gridColumn,
                                    'target' => ExportMenu::TARGET_BLANK,
                                    'fontAwesome' => true,
                                    'dropdownOptions' => [
                                        'label' => 'Full',
                                        'class' => 'btn btn-default',
                                        'itemsBefore' => [
                                            '<li class="dropdown-header">Export All Data</li>',
                                        ],
                                    ],
                                                        'exportConfig' => [
                                        ExportMenu::FORMAT_PDF => false
                                    ]
                                                    ]) ,
                            ],
                        ]); ?>
                                    </div>
            </div>
        </div>
    </div>

</div>
