<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ApplyForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;

?>
<div class="ajax-form-modal-wrapper">
    <header>
    </header>
    <?php $form = ActiveForm::begin([
        'action' => '/site/apply',
        'options' => ['enctype' => 'multipart/form-data'],
    ]) ?>
        <h1 class="fg-blue text-center">העלאת קובץ קורות חיים</h1>
        <div class="select-file flex center">
            <?= $form->field($model, 'cvFile')->fileInput(['class' => 'hidden'])->label('גרור לכאן קובץ או <span>העלה מהמחשב</span>') ?>
            <?= $form->field($model, 'jobId')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'jobCode')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'jobTitle')->hiddenInput()->label(false) ?>
        </div>
        <div class="drag-file-area flex center" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);">
            <?= Html::img('/images/pdf.png', ['alt' => 'PDF file', 'width' => '60']) ?>
            <?= Html::img('/images/word.png', ['alt' => 'Word file', 'width' => '60']) ?>
        </div>

        <button class="btn memad3 blue center-block">שליחה</button>

    <?php ActiveForm::end() ?>
</div>
