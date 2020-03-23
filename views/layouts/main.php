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


        <?php $this->registerCsrfMetaTags() ?>
        <title><?= $this->title ?></title>
        <?php $this->head() ?>
    </head>
    
    <body dir="rtl">
    <?php $this->beginBody() ?>
        
        <?= $content ?> 
        
        <footer class="footer">
        </footer>

    <?php $this->endBody() ?>
    </body>
    
</html>
<?php $this->endPage() ?>
