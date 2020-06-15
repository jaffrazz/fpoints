<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\WaliMurid */

$this->title = $model->nama_wali_murid;
$this->params['breadcrumbs'][] = ['label' => 'Wali Murid', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wali-murid-view">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">

                    <?=Html::a('Update', ['update', 'id' => $model->id_wali_murid], ['class' => 'btn btn-primary'])?>
                    <?=Html::a('Delete', ['delete', 'id' => $model->id_wali_murid], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </div>
                <div class="box-body">
                    <!-- <div class="row"> -->
                    <?php
                    $gridColumn = [
                        ['attribute' => 'id_wali_murid', 'visible' => false],
                        'nama_wali_murid',
                        'alamat_rumah_wali_murid:ntext',
                        'tempat_lahir_wali_murid',
                        'tanggal_lahir_wali_murid',
                        [
                            'attribute' => 'pekerjaan.id_pekerjaan',
                            'label' => 'Pekerjaan',
                            'value' => function($model){
                                return $model->pekerjaan->nama_pekerjaan;
                            }
                        ],
                        [
                            'attribute' => 'agama.agama',
                            'label' => 'Agama',
                            'value' => function($model){
                                return $model->agama->agama;
                            }
                        ],
                        [
                            'attribute' => 'jenis_kelamin_wali_murid',
                            'value' => function($model){
                                return ($model->jenis_kelamin_wali_murid) ? 'Laki-laki' : 'Perempuan' ;
                            }
                        ],
                        'no_hp_wali_murid',
                    ];
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => $gridColumn,
                    ]);
                    ?>
                    <!-- </div> -->

                    <div class="pt-3">
                        <?php
                        if ($providerSiswa->totalCount) {
                            $gridColumnSiswa = [
                                ['class' => 'yii\grid\SerialColumn'],
                                ['attribute' => 'id_wali_murid', 'visible' => false],
                                'nis',
                                'nama_siswa',
                                [
                                    'attribute' => 'kelas',
                                    'value' => function($model) {
                                        return $model->onKelasSiswa->kelas->namaKelas->nama_kelas;
                                    }
                                ],
                                'no_hp_siswa',
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view}',
                                    'urlCreator' => function ($action, $model, $key, $index) {
                                        if ($action === 'view') {
                                            $url =Yii::$app->homeUrl.'/siswa/view?id='.$model->id_siswa;
                                            return $url;
                                        }
                                    }
                                ],
                                // [
                                //     'attribute' => 'ttl.siswa',
                                //     'label' => 'TTL',
                                //     'value' => function($model){
                                //         return $model->tempat_lahir_siswa. ", ". $model->tanggal_lahir_siswa;
                                //     }
                                // ],
                                // [
                                //     'attribute' => 'jenis_kelamin_siswa',
                                //     'label' => 'Jenis Kelamin',
                                //     'value' => function($model){
                                //         return ($model->jenis_kelamin_siswa == 'L') ? 'Laki-laki' : 'Perempuan';
                                //     }
                                // ],
                            ];
                            echo Gridview::widget([
                                'dataProvider' => $providerSiswa,
                                'pjax' => true,
                                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-siswa']],
                                'panel' => [
                                    //'type' => GridView::TYPE_PRIMARY,
                                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Anak'),
                                ],
                                'export' => false,
                                'columns' => $gridColumnSiswa,
                            ]);
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>