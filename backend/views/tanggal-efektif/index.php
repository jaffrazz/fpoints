<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\TanggalEfektifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'Tanggal Efektif';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="tanggal-efektif-index">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <p>
                        <?=Html::a('Create Tanggal Efektif', ['create'], ['class' => 'btn btn-success'])?>
                    </p>
                </div>
                <div class="box-body">
                    <?php
					$gridColumn = [
						['class' => 'yii\grid\SerialColumn'],
						['attribute' => 'id_tanggal_efektif', 'visible' => false],
						[
							'attribute' => 'tanggal_efektif',
							'format' => 'date',
							'filterType' => GridView::FILTER_DATE,
								'filterWidgetOptions' => [
								'size' => 'xs',
								'pluginOptions' => [
									'format' => 'dd-M-yyyy',
									'autoWidget' => true,
									'autoclose' => true,
									'todayHighlight' => true
								]
							],
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
						'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-tanggal-efektif']],
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