<?php

/* @var $this yii\web\View */
/* @var $jobs jobs array */
use app\widgets\memadSearch\MemadSearchWidget;
use app\widgets\memadJob\MemadJobWidget;
use yii\helpers\Url;
use app\widgets\memadSubmit\MemadSubmitWidget;

$this->title = 'המימד השלישי - לוח המשרות';

$js = <<<JS
    location.href = '#search-result';
JS;
$this->registerJs($js);?>

<?= MemadSubmitWidget::widget() ?>

<div class="site-jobs">
    <header class="header-jobs">
        <h1 class="fg-white text-center">לוח המשרות שלנו</h1>
    </header>

    <?= MemadSearchWidget::widget([
        'model' => $this->params['serachFormModel'],
        'inline' => true,
        'wrapClass' => 'flex center fg-white',
    ]) ?>
    
    <section id="search-result" class="job-list center-block">
        <?php foreach($jobs as $job) : ?>
        <?= MemadJobWidget::widget(['job' => $job]) ?>
        <?php endforeach; ?>
    </section>
</div>
