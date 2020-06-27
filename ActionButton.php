<?php


namespace backend\views\sp;


use yii\helpers\Html;

class ActionButton
{
    public static function getButtons()
    {
        return [
            'class' => 'yii\grid\ActionColumn',
            'template' => ' {delete} ',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a("<i class='fa fa-eye'></i>", ["view", "id"=>$model->id_sp], ["class"=>"btn btn-primary", "title"=>"View"]);
                },
                'update' => function ($url, $model, $key) {
                    return Html::a("<i class='fa fa-pencil'></i>", ["update", "id"=>$model->id_sp], ["class"=>"btn btn-warning", "title"=>"Edit"]);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a("<i class='fa fa-trash'></i>", ["delete", "id"=>$model->id_sp], [
                        "class"=>"btn btn-danger",
                        "title"=>"Delete",
                        "data-confirm" => "Apakah Anda yakin ingin menghapus data ini ?",
                        "data-method" => "POST"
                    ]);
                },
            ],
            'contentOptions' => ['nowrap'=>'nowrap', 'style'=>'text-align:center;width:140px']
        ];
    }
}