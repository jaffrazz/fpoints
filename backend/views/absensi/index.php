<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\AbsensiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'Absensi';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="absensi-index">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <p>
                        <?=Html::a('Create Absensi', ['create'], ['class' => 'btn btn-success'])?>
                        <?=Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button'])?>
                    </p>
                    <div class="search-form" style="display:none">
                        <?=$this->render('_search', ['model' => $searchModel]);?>
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    $gridColumn = [
                        ['class' => 'yii\grid\SerialColumn'],
                        ['attribute' => 'id_absensi', 'visible' => false],
                        [
                            'attribute' => 'id_siswa',
                            'label' => 'Siswa',
                            'value' => function ($model) {
                                return $model->siswa->nama_siswa;
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => \yii\helpers\ArrayHelper::map(\common\models\Siswa::find()->asArray()->all(), 'id_siswa', 'nama_siswa'),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => 'Siswa', 'id' => 'grid-absensi-search-id_siswa'],
                        ],
                        [
                            'attribute' => 'id_status_absensi',
                            'label' => 'Status Absensi',
                            'value' => function ($model) {
                                return $model->statusAbsensi->id_status_absensi;
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => \yii\helpers\ArrayHelper::map(\common\models\StatusAbsensi::find()->asArray()->all(), 'id_status_absensi', 'id_status_absensi'),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => 'Status absensi', 'id' => 'grid-absensi-search-id_status_absensi'],
                        ],
                        [
                            'attribute' => 'id_tanggal_efektif',
                            'label' => 'Tanggal Efektif',
                            'value' => function ($model) {
                                return $model->tanggalEfektif->tanggal_efektif;
                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => \yii\helpers\ArrayHelper::map(\common\models\TanggalEfektif::find()->asArray()->all(), 'id_tanggal_efektif', 'tanggal_efektif'),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => 'Tanggal efektif', 'id' => 'grid-absensi-search-id_tanggal_efektif'],
                        ],
                        // 'keterangan:ntext',
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
                        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-absensi']],
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