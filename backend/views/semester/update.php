<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Semester */

$this->title = 'Update Semester: ' . ' ' . $model->semester;
$this->params['breadcrumbs'][] = ['label' => 'Semester', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->semester, 'url' => ['view', 'id' => $model->id_semester]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="semester-update">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <?= $this->render('_form', [
                        'model' => $model,
                        'bulan' => $bulan,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
