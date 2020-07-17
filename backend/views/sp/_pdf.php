<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Sp */

$this->title = $model->id_sp;
$this->params['breadcrumbs'][] = ['label' => 'Sp', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sp-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Sp'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        'id_sp',
        [
                'attribute' => 'siswa.id_siswa',
                'label' => 'Id Siswa'
            ],
        'sp_ke',
        'tanggal_sp',
        'jml_point_pelanggaran',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
