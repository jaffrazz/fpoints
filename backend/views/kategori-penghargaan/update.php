<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\KategoriPenghargaan */

$title = explode(' ', $model->kategori_penghargaan);

if(count($title) > 4){
    $title = implode(' ', array_slice($title,0,3) ). "...";
}else{
    $title = implode(' ',$title);
}

$this->title = 'Update Kategori Penghargaan: ' . ' ' . $title;
$this->params['breadcrumbs'][] = ['label' => 'Kategori Penghargaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['view', 'id' => $model->id_kategori_penghargaan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kategori-penghargaan-update">
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
