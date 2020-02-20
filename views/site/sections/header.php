<?php
    use app\widgets\memadSearch\MemadSearchWidget;
    use app\widgets\freeSearch\FreeSearchWidget;
    use yii\helpers\Html;
    use yii\helpers\Url;
    
$js = <<<JS
    $(document).ready(function() {
        $('.action-buttons a.free-search').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).parents('p').addClass('hidden');
            $('.free-search-wrapper.hidden').removeClass('hidden');
            return false;
        });
    });
JS;
    
    $this->registerJs($js);
?>

<div class="memad3-jumbotron">
    <h1 class="text-extra-light fg-blue">Let’s catch your next</h1>
    <h1 class="text-extra-bold fg-blue">Job opportunity</h1>

 
    <div class="actions">
        <p class="action-buttons">
            <?= Html::a('חפש משרה', '/site/jobs', ['class' => 'btn btn-md memad3 blue free-search']) ?>
            <?= Html::button('הגש קו"ח', [
                'class' => 'btn btn-md memad3 white show-ajax-modal',
                'data-ajax-form-url' => Url::to('/site/apply'),
                'data-job-id' => '',
                'data-job-title' => 'לא נבחרה משרה (קן״ח בלבד)',
            ]) ?>
        </p>
        
        <?= FreeSearchWidget::widget([
            'model' => $serachFormModel,
            'inline' => true,
            'wrapClass' => 'flex flex-wrap center fg-blue hidden',
            'prompt' => 'איזו משרה את/ה מחפש/ת?',
        ]) ?>
    </div>
</div>

<?= MemadSearchWidget::widget([
    'model' => $serachFormModel,
    'inline' => true,
    'wrapClass' => 'flex center fg-white',
    'intro' => 'מחפש משרה ספציפית?',
]) ?>
