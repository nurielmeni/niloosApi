<?php
    use app\widgets\memadSearch\MemadSearchWidget;
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<div class="memad3-jumbotron">
    <h1 class="text-extra-light fg-blue">Let’s catch your next</h1>
    <h1 class="text-extra-bold fg-blue">Job opportunity</h1>

 
    <p class="actions">
        <?= Html::a('חפש משרה', '/site/jobs', ['class' => 'btn btn-md memad3 blue']) ?>
        <?= Html::button('הגש קו"ח', [
            'class' => 'btn btn-md memad3 white show-ajax-modal',
            'data-ajax-form-url' => Url::to('/site/apply'),
            'data-job-id' => '',
            'data-job-title' => 'לא נבחרה משרה (קן״ח בלבד)',
        ]) ?>
    </p>
</div>

<?= MemadSearchWidget::widget([
    'model' => $serachFormModel,
    'inline' => true,
    'wrapClass' => 'flex center fg-white',
    'intro' => 'מחפש משרה ספציפית?',
]) ?>
