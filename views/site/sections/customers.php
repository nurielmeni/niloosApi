<?php
/**
 * $items the carousel items
 * $id the carousel id
 */
use yii\helpers\Url;
use yii\helpers\Html;
use app\widgets\owlCarousel\OwlCarousel;

echo Html::tag('h2', 'לקוחותינו', ['class' => 'memad-section-title  text-center']);

$items = [
    [
        'img' => Url::to('@web/images/logo.png'),
        'alt' => 'logo',
        'caption' => 'Logo 1',
    ],
];

echo \app\widgets\slickCarousel\SlickCarousel::widget([
    'items' => $items,
    'folder' => \Yii::$app->basePath . ('/public_html/uploads/customers/'),
]);
