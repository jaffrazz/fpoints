<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\KategoriPenghargaan */

$this->title = 'Create Kategori Penghargaan';
$this->params['breadcrumbs'][] = ['label' => 'Kategori Penghargaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-penghargaan-create">
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
