<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TahunAjaran */

$this->title = 'Create Tahun Ajaran';
$this->params['breadcrumbs'][] = ['label' => 'Tahun Ajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tahun-ajaran-create">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <?= $this->render('_form', [
                        'model' => $model,
                        'tahunAjaran' => $tahunAjaran,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
