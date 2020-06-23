<?php
use yii\helpers\Html;

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

    // set profile pictures
    $web =\yii\helpers\Url::to('@web/uploaded/profile/');
    $webroot =\yii\helpers\Url::to('@webroot/uploaded/profile/');

    $pegawai = \common\models\Pegawai::findOne(Yii::$app->user->identity->id_pegawai);

    $path_profile = $web . $pegawai->foto_pegawai;
    $real_path_profile = $webroot . $pegawai->foto_pegawai;

    $defaul_profile = $directoryAsset . "/img/user2-160x160.jpg";

    $profilePict = ( file_exists($real_path_profile) ) ? $path_profile : $defaul_profile;

    // initial nama pegawai
    $namaPegawai = $pegawai->nama_pegawai;

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
            ['directoryAsset' => $directoryAsset, 'profilePict' => $profilePict,  'namaPegawai' => $namaPegawai]
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
