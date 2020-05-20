<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <?= $form->field($model, 'project', ['options' => ['class' => 'col-sm-4 col-xs-12']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'languageCode', ['options' => ['class' => 'col-sm-4 col-xs-12']])->textInput() ?>
    </div>
    
    
    <div class="row">
        <?= $form->field($model, 'fromMail', ['options' => ['class' => 'col-sm-6 col-xs-12']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'toMail', ['options' => ['class' => 'col-sm-6 col-xs-12']])->textInput(['maxlength' => true]) ?>
    </div>
        
    <div class="row">
        <?= $form->field($model, 'fromName', ['options' => ['class' => 'col-sm-6 col-xs-12']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nsoftSiteId', ['options' => ['class' => 'col-sm-6 col-xs-12']])->textInput(['maxlength' => true]) ?>
    </div>
        
    <div class="row">
        <?= $form->field($model, 'nsoftApplicationId', ['options' => ['class' => 'col-sm-6 col-xs-12']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'categorySupplierId', ['options' => ['class' => 'col-sm-6 col-xs-12']])->textInput(['maxlength' => true]) ?>
    </div>
        
    <div class="row">
        <?= $form->field($model, 'nlsCardsWsdlUrl', ['options' => ['class' => 'col-sm-6 col-xs-12']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nlsSecurityWsdlUrl', ['options' => ['class' => 'col-sm-6 col-xs-12']])->textInput(['maxlength' => true]) ?>
    </div>
        
    <div class="row">
        <?= $form->field($model, 'nlsDirectoryWsdlUrl', ['options' => ['class' => 'col-sm-6 col-xs-12']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'searchServiceWsdlUrl', ['options' => ['class' => 'col-sm-6 col-xs-12']])->textInput(['maxlength' => true]) ?>  
    </div>
        
    <div class="row">
        <?= $form->field($model, 'nlsSecurityDomain', ['options' => ['class' => 'col-sm-4 col-xs-12']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nlsSecurityUsername', ['options' => ['class' => 'col-sm-4 col-xs-12']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nlsSecurityPassword', ['options' => ['class' => 'col-sm-4 col-xs-12']])->textInput(['maxlength' => true]) ?>
    </div>
        
    <div class="row">
        <?= $form->field($model, 'categoryIDs', ['options' => ['class' => 'col-xs-12']])->textarea(['rows' => 3]) ?>
    </div>
        
    <div class="row">
        <?= $form->field($model, 'trace', ['options' => ['class' => 'col-sm-4 col-xs-12']])->textInput() ?>

        <?= $form->field($model, 'exceptions', ['options' => ['class' => 'col-sm-4 col-xs-12']])->textInput() ?>

        <?= $form->field($model, 'cacheWsdl', ['options' => ['class' => 'col-sm-4 col-xs-12']])->textInput() ?>
    </div>
        
    <div class="row">
        <?= $form->field($model, 'active', ['options' => ['class' => 'col-xs-2']])->checkbox() ?>
        
        <?= $form->field($model, 'siteAddress', ['options' => ['class' => 'col-xs-10']])->textInput(['maxlength' => true]) ?>
    </div>
        
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
