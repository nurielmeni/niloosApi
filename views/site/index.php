<?php

/* @var $this yii\web\View */
use app\widgets\memadSearch\MemadSearchWidget;
use yii\helpers\Url;
use app\widgets\memadSubmit\MemadSubmitWidget;

$this->title = Yii::$app->name;
?>

<?= MemadSubmitWidget::widget() ?>

<div class="site-index">

    <section class="header">
        <?= $this->render('sections/header', ['serachFormModel' => $this->params['serachFormModel']]) ?>
    </section>
    
    <section class="about">
        <?= $this->render('sections/about') ?>
    </section>
    
    <section class="customers">
        <?= $this->render('sections/customers') ?>
    </section>
    
</div>
