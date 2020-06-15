<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TahunAjaran */

$this->title = 'Update Tahun Ajaran: ' . ' ' . $model->tahun_ajaran;
$this->params['breadcrumbs'][] = ['label' => 'Tahun Ajaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tahun_ajaran, 'url' => ['view', 'id' => $model->id_tahun_ajaran]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tahun-ajaran-update">
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
