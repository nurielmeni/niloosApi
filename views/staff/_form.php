<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\imageInput\ImageInputWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jobTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'dir' => 'ltr']) ?>

    <?= $form->field($model, 'linkedin')->textInput(['maxlength' => true, 'dir' => 'ltr']) ?>

    <?= $form->field($model, 'imageUrl')->widget(ImageInputWidget::class, [
            'htmlOptions' => ['style' => 'cursor: pointer;'],
            'placeHolder' => 'uploads/theme/placeholder.svg',
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
