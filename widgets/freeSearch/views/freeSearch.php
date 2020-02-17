<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>
<div class="free-search-wrapper <?= $wrapClass . ($inline ? ' inline' : '') ?>">



    <?= Html::tag('label', $prompt, ['class' => 'visible-xs'])?>
    <?php if (isset($action)) : ?>
        <?php $form = ActiveForm::begin([
            'action' => [$action], 
            'id' => 'search-form' . $name,
            'options' => ['class' => 'flex center flex-wrap ' . ($inline ? 'row' : 'column')]
        ]); ?>   
    <?php else : ?>
        <?php $form = ActiveForm::begin([
            'id' => 'search-form' . $name,
            'options' => ['class' => 'text-center flex center flex-wrap ' . ($inline ? 'row' : 'column')]
        ]); ?>   
    <?php endif; ?>
        <?= $form->field($model, 'freetext', ['options' => ['class' =>  $inline ? 'form-group flex' : 'form-group']])->textInput([
            'prompt' => $model->getAttributeLabel('freeText'),
            'class' => 'free-text',
        ])->label($prompt, ['class' => 'hidden-xs']) ?>

        <div class="form-group">
            <?= Html::submitButton($submitLabel, ['class' => 'btn memad3 light-blue fg-white', 'name' => 'search-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>


</div>
