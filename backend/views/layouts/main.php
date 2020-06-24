<?php
use yii\helpers\Html;
use backend\helpers\File;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

    $pegawai = \common\models\Pegawai::findOne(Yii::$app->user->identity->id_pegawai);

    $default_profile = $directoryAsset . "/img/user2-160x160.jpg";

    $profilePict = File::check('uploaded/profile', $pegawai->foto_pegawai, $default_profile, true);

    // initial nama pegawai
    $namaPegawai = $pegawai->nama_pegawai;
    $statusKepegawaian = $pegawai->status_kepegawaian;
    $jabatan = $pegawai->jabatan->jabatan;

$js =
    <<<Js
    let inputs = document.querySelectorAll('input[type=text]');
    if(inputs.length){
        inputs.forEach(input => (input.hasAttribute('data-datepicker-source')) ? input.setAttribute('autocomplete','off') : '' )
    }
Js;
$this->registerJs($js);

    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition <?= \dmstr\helpers\AdminLteHelper::skinClass() ?> sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            [
                'directoryAsset' => $directoryAsset,
                'profilePict' => $profilePict,
                'namaPegawai' => $namaPegawai,
                'jabatan' => $jabatan,
                'statusKepegawaian' => $statusKepegawaian
            ]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset, 'profilePict' => $profilePict,  'namaPegawai' => $namaPegawai]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
