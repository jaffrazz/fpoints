<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\PegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'Pegawai';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="pegawai-index">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <p>
                        <?=Html::a('Create Pegawai', ['create'], ['class' => 'btn btn-success'])?>
                        <?=Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button'])?>
                    </p>
                    <div class="search-form" style="display:none">
                        <?=$this->render('_search', ['model' => $searchModel, 'status_kepegawaian' => $status_kepegawaian]);?>
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    $gridColumn = [
                        ['class' => 'yii\grid\SerialColumn'],
                        ['attribute' => 'id_pegawai', 'visible' => false],
                        'nama_pegawai',
                        'alamat_pegawai:ntext',
                        [
                            'attribute' => 'id_agama',
                            'label' => 'Agama',
                            'value' => function ($model) {
                                return $model->agama->agama;
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => \yii\helpers\ArrayHelper::map(\common\models\Agama::find()->asArray()->all(), 'id_agama', 'agama'),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => 'Agama', 'id' => 'grid-pegawai-search-id_agama'],
                        ],
                        [
                            'attribute' => 'jenis_kelamin_pegawai',
                            'value' => function ($model) {
                                return ($model->jenis_kelamin_pegawai == 'L') ? 'Laki-laki' : 'Perempuan';
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => [ 'L' => 'Laki-laki', 'P' => 'Perempuan', ],
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => 'Jenis Kelamin', 'id' => 'grid-pegawai-search-jenis_kelamin_pegawai'],
                        ],
                        [
                            'attribute' => 'status_kepegawaian',
                            'label' => 'Status Kepegawaian',
                            'value' => function ($model) {
                                return $model->status_kepegawaian;
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => $status_kepegawaian,
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => 'Status Kepegawaian', 'id' => 'grid-pegawai-search-status_kepegawaian'],
                        ],
                        [
                            'attribute' => 'jabatan_pegawai',
                            'label' => 'Jabatan',
                            'value' => function ($model) {
                                return $model->jabatan->jabatan;
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => \yii\helpers\ArrayHelper::map(\common\models\Jabatan::find()->asArray()->all(), 'id_jabatan', 'jabatan'),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => 'Jabatan', 'id' => 'grid-pegawai-search-id_jabatan'],
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
                        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-pegawai']],
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