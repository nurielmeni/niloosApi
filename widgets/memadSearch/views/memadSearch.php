<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\widgets\customSelect\CustomSelectWidget;


?>
<div class="memad-search-wrapper <?= $wrapClass . ($inline ? ' inline' : '') ?>">



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

        <?= $form->field($model, 'location', ['options' => ['class' =>  $inline ? 'form-group flex' : 'form-group']])->dropDownList($model->locationOptions, [
            'prompt' => $model->getAttributeLabel('location'),
            'class' => 'nice-select',
        ])->label($intro) ?>

        <?= $form->field($model, 'profession')->dropDownList($model->professionOptions, [
            'prompt' => $model->getAttributeLabel('profession'),
            'class' => 'nice-select'
        ])->label(false) ?>
   
        <div class="form-group">
            <?= Html::submitButton($submitLabel, ['class' => 'btn memad3 gradiant fg-white', 'name' => 'search-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>


</div>
