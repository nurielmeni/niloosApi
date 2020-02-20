<?php

/* @var $this yii\web\View */
/* @var $jobs jobs array */
use app\widgets\memadSearch\MemadSearchWidget;
use app\widgets\memadJob\MemadJobWidget;
use yii\helpers\Url;
use app\widgets\memadSubmit\MemadSubmitWidget;

$this->title = 'המימד השלישי - ' . $job['JobTitle'];

$this->registerMetaTag([
    'property' => 'og:description',
    'content' => $job['Requiremets'],
]);
$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $job['JobTitle'],
]);
$this->registerMetaTag([
    'property' => 'og:url',
    'content' => Url::to('site/job/' . $job['JobId'], true),
]);

$js = <<<JS
    location.href = '#job-details';
JS;
$this->registerJs($js);
?>

<div class="site-jobs">
    <header class="header-jobs single-job">
        <h1 class="fg-white text-center"><?= $job['JobTitle'] ?></h1>
    </header>

    <?= MemadSearchWidget::widget([
        'model' => $this->params['serachFormModel'],
        'inline' => true,
        'wrapClass' => 'flex center fg-white',
    ]) ?>
    
    <section id="job-details" class="job-list center-block">
        <?= MemadJobWidget::widget(['job' => $job, 'showHeaders' => true]) ?>
    </section>
</div>
<?= MemadSubmitWidget::widget() ?>
