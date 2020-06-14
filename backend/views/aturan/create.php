<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Aturan */

$this->title = 'Create Aturan';
$this->params['breadcrumbs'][] = ['label' => 'Aturan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aturan-create">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
