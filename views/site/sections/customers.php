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
    [
        'img' => Url::to('@web/images/logo.png'),
        'alt' => 'logo',
        'caption' => 'Logo 2',
    ],
    [
        'img' => Url::to('@web/images/logo.png'),
        'alt' => 'logo',
        'caption' => 'Logo 3',
    ],
    [
        'img' => Url::to('@web/images/logo.png'),
        'alt' => 'logo',
        'caption' => 'Logo 4',
    ],                
    [
        'img' => Url::to('@web/images/logo.png'),
        'alt' => 'logo',
        'caption' => 'Logo 4',
    ],                
    [
        'img' => Url::to('@web/images/logo.png'),
        'alt' => 'logo',
        'caption' => 'Logo 4',
    ],                
    [
        'img' => Url::to('@web/images/logo.png'),
        'alt' => 'logo',
        'caption' => 'Logo 4',
    ],                
    [
        'img' => Url::to('@web/images/logo.png'),
        'alt' => 'logo',
        'caption' => 'Logo 4',
    ],                
    [
        'img' => Url::to('@web/images/logo.png'),
        'alt' => 'logo',
        'caption' => 'Logo 4',
    ],                
];

echo \app\widgets\slickCarousel\SlickCarousel::widget([
    'items' => $items,
]);
