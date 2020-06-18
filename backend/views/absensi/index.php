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

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                            'attribute' => 'id_kelas',
                            'label' => 'Kelas',
                            'value' => function ($model) {
                                return $model->kelas->namaKelas->nama_kelas;

                            },
                            'filterType' => GridView::FILTER_SELECT2,
                            'filter' => \yii\helpers\ArrayHelper::map(\common\models\Kelas::find()->joinWith('namaKelas')->asArray()->all(), 'id_kelas', 'namaKelas.nama_kelas'),
                            'filterWidgetOptions' => [
                                'pluginOptions' => ['allowClear' => true],
                            ],
                            'filterInputOptions' => ['placeholder' => 'Kelas', 'id' => 'grid-absensi-search-id_kelas'],
                        ],
                        [
                            'attribute' => 'tanggal_efektif',
                            'filter' => false
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