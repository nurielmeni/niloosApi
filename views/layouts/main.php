<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\memadLogoNav\MemadLogoNav;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="language" content="Hebrew">
    <meta name="author" content="Meni Nuriel">
    <meta charset="<?= Yii::$app->charset ?>">
    
    <meta property="og:image" content="<?= Url::to('@web/images/logo.png') ?>" />

    <link rel="icon" type="image/png" href="<?= Url::to('@web/images/logo.png') ?>" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body dir="rtl">
<?php $this->beginBody() ?>

<div class="wrap <?= $this->params['requestedRout'] ?>">
    <?=  MemadLogoNav::widget(['wrapClass' => 'visible-xs' . ($this->params['requestedRout'] == 'site-index' ? ' fg-blue' : ' fg-white')]) ?>

    <?php NavBar::begin([
        'brandUrl' => false,
        'renderInnerContainer' => true,
        'headerContent' => \app\widgets\Memad3Social::widget([
            'socials' => [
                'in' => key_exists('memadIn', Yii::$app->params) ? Yii::$app->params['memadIn'] : '#_',
                'f' => key_exists('memadIn', Yii::$app->params) ? Yii::$app->params['memadFb'] : '#_',
            ]
        ]),
        'options' => [
            'class' => 'navbar navbar-static-top',
        ],
    ]); ?>
    
    <?= $this->render('nav', ['class' => 'navbar-header' . ($this->params['requestedRout'] == 'site-index' ? ' fg-blue' : ' fg-white'), 'user' => false]) ?>
    
    <?= MemadLogoNav::widget(['wrapClass' => 'hidden-xs' . ($this->params['requestedRout'] == 'site-index' ? ' fg-blue' : ' fg-white')]) ?>
    
    <?php NavBar::end(); ?>

    <main>
        <?= Alert::widget() ?>
        <?= $content ?>
    </main>
</div>

<footer class="footer">
    <?= $this->render('footer', ['model' => $this->params['serachFormModel']]) ?>
</footer>

<?php $this->endBody() ?>
    
<?php if (isset($anchor) && strlen($anchor)) : ?>
<?php 
$js = <<<JS
    location.hash=$anchor;
JS;
$this->registerScript($js);
?>
<?php endif; ?>
</body>
</html>
<?php $this->endPage() ?>
