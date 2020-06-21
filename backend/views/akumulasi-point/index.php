<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\AkumulasiPointSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'Akumulasi Point';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="akumulasi-point-index">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">

                    <p>
                        <?=Html::a('Create Akumulasi Point', ['create'], ['class' => 'btn btn-success'])?>
                    </p>
                </div>
                <div class="box-body">
                    <?php
                    $gridColumn = [
                        ['class' => 'yii\grid\SerialColumn'],
                        ['attribute' => 'id_akumulasi_point', 'visible' => false],
                        [
                            'attribute' => 'id_tahun_ajaran',
                            'label' => 'Tahun Ajaran',
                            'value' => function ($model) {
                                return $model->tahunAjaran->tahun_ajaran;
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => \yii\helpers\ArrayHelper::map(\common\models\TahunAjaran::find()->asArray()->all(), 'id_tahun_ajaran', 'tahun_ajaran'),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => 'Tahun ajaran', 'id' => 'grid-akumulasi-point-search-id_tahun_ajaran'],
                        ],
                        [
                            'attribute' => 'id_semester',
                            'label' => 'Semester',
                            'value' => function ($model) {
                                return $model->semester->semester;
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => \yii\helpers\ArrayHelper::map(\common\models\Semester::find()->asArray()->all(), 'id_semester', 'semester'),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => 'Semester', 'id' => 'grid-akumulasi-point-search-id_semester'],
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                        ],
                    ];
                    ?>
                    <?=GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => $gridColumn,
                        'pjax' => true,
                        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-akumulasi-point']],
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
                                    ExportMenu::FORMAT_PDF => false,
                                ],
                            ]),
                        ],
                    ]);?>
                </div>
            </div>
        </div>
    </div>

</div>