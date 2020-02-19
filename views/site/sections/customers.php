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
];

echo \app\widgets\slickCarousel\SlickCarousel::widget([
    'items' => $items,
    'publicPath' => '/public_html', /* Prod (default "web" works in dev */
    'folder' => '/uploads/customers/',
]);
