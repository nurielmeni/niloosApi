<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

$this->title = 'צור קשר';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
        

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <?php Modal::begin([
            'headerOptions' => ['style' => 'background: url("' . Url::to('@web/images/contact-modal-header.jpg') . '") no-repeat center center; background-size: 100%; height: 420px;'],
            'bodyOptions' => ['class' => 'text-center']]); ?>
    
            <h1>תודה על פנייתך!</h1>
            <p>לאחר עדכון קורות החיים שלך במערכת הגיוס שלנו,
        תקבל/י מאיתנו אישור לכותובת המייל המעודכנת בקורות החיים.</p>
            <p class="no-margin">תודה ובהצלחה,</p>
            <p>׳המימד השלישי גיוס והשמה׳</p>
            
        <?php Modal::end(); ?>
      
    <?php endif; ?>
        <header>
            <h1 class="text-center fg-white">מעסיקים</h1>
        </header>
        <div class="flex center flex-rwrap contact-body employers">
            <div class="left">
                <div class="employer-info bg-blue fg-white flex column space-between">
                    <p class="first">נשמח לתת לכם מענה ולהתאים עבורכם מנהל/ת לקוח
שילווה את התהליכים מקצה לקצה תוך מתן מענה מקצועי 
וממוקד לדרישות הגיוס בחרתכם.</p>
                    <p class="second fg-light-blue">לפרטי נוספים, מוזמנים לפנות לטליה וורצקי,
מנהלת השיווק של ׳המימד השלישי׳</p>
                    <p class="third">טלפון      054-6868011 | 072-2201112
מייל         talya@memad3.com</p>
                </div>
            </div>
            <div class="right">
                <p>השאירו לנו פרטים ונחזור אליכם בהקדם</p>


                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <div class="inline-fields flex flex-wrap space-between">
                        <?= $form->field($model, 'name')->textInput(['placeholder' => $model->getAttributeLabel('name'), 'autofocus' => true])->label(false) ?>

                        <?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')])->label(false) ?>
                    </div>
                    
                    <?= $form->field($model, 'body')->textarea(['rows' => 6, 'placeholder' => $model->getAttributeLabel('body')])->label(false) ?>

                    <div class="form-group">
                        <?= Html::submitButton('שלחו', ['class' => 'btn memad3 trans fg-blue', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

</div>
