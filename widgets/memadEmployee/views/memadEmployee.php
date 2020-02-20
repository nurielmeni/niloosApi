<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\widgets\customSelect\CustomSelectWidget;


?>
<div class="memad-employee-wrapper <?= $wrapClass ?>">
    <div class="panel panel-default">
        
        <div class="panel-heading" style="background: url('<?= Url::to('@web/' . $model->imageUrl) ?>') no-repeat center center; background-size: cover;"></div>
        
        <div class="panel-body">
            <div class="flex space-between">
                <span class="name"><?= $model->fullname ?></span>
                <div class="actions flex">
                    <?php if (strlen($model->email) > 4) : ?>
                        <a href="mailto:<?= $model->email ?>" class="mail glyphicon glyphicon-envelope bg-gradiant circle-button fg-white"></a>
                    <?php endif; ?>
                    <?php if (strlen($model->linkedin) > 4) : ?>
                        <a href="<?= $model->linkedin ?>" class="linkedin bg-gradiant circle-button fg-white">in</a>
                    <?php endif; ?>
                </div>
            </div>
            <p class="job-title"><?= $model->jobTitle ?></p>
            <p class="description"><?= $model->description ?></p>
        </div>
    </div>    
</div>
