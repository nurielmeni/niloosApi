<?php

use yii\helpers\Url;
use app\widgets\Memad3Social;
use app\widgets\memadSearch\MemadSearchWidget;
use app\widgets\MemadLogo;
?>

<div class="row" style="margin: 0;">
    <div class="col-xs-12 col-sm-5 links flex space-around">
        <?= $this->render('nav', ['class' => 'flex column']) ?>
        
        <?= Memad3Social::widget([
            'socials' => [
                'in' => key_exists('memadIn', Yii::$app->params) ? Yii::$app->params['memadIn'] : '#_',
                'f' => key_exists('memadFb', Yii::$app->params) ? Yii::$app->params['memadFb'] : '#_',
                'ins' => key_exists('memadIns', Yii::$app->params) ? Yii::$app->params['memadIns'] : '#_',
            ]
        ]) ?>
    </div>
    <div class="col-xs-12 col-sm-4 search">
        <?= MemadSearchWidget::widget([
            'model' => $model,
            'inline' => false,
            'wrapClass' => 'flex center fg-blue',
            'intro' => 'מחפש משרה ספציפית?',
        ]) ?>
    </div>
    <div class="col-xs-12 col-sm-3 logo">
        <?= MemadLogo::widget(['color' => '#004374']) ?>
    </div>
   
</div>