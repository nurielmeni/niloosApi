<?php
    use app\assets\AppAsset;
?>

<?php AppAsset::register($this); ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="language" content="English">
        <meta name="author" content="Meni Nuriel">
        <meta charset="<?= Yii::$app->charset ?>">


        <?php $this->registerCsrfMetaTags() ?>
        <title><?= $this->title ?></title>
        <?php $this->head() ?>
    </head>
    
    <body dir="<?= Yii::$app->language === 'he-IL' ? 'rtl' : 'ltr' ?>">
    <?php $this->beginBody() ?>
        <div class="wrap">
            <?php require_once 'nav.php'; ?>
        
            <main class="container">
            <?= $content ?> 
            </main>
            
            <footer class="footer">
            </footer>

        </div>
    <?php $this->endBody() ?>
    </body>
    
</html>
<?php $this->endPage() ?>
