<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Semester */

$this->title = 'Create Semester';
$this->params['breadcrumbs'][] = ['label' => 'Semester', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semester-create">
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
