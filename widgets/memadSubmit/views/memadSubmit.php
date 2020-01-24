<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

?>

<?php
    Modal::begin([
        'header' => $header,
        'id' =>  'ajax-form-modal',
        'footer' => $footer,
        'options' => ['class' => 'ajax-form-modal ' . $name],
    ]);
?>
<div class="memad-submit-wrapper <?= $wrapClass ?>">
    <?= $body ?>
</div>



<?php
    Modal::end();
?>