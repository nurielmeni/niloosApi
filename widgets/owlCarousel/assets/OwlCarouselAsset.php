<?php

namespace app\widgets\owlCarousel\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class OwlCarouselAsset extends AssetBundle {

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
    public $sourcePath = '@app/widgets/owlCarousel/assets';
    public $css = [
        'css/owl.carousel.min',
        'css/owl.theme.default.css',
    ];
    public $js = [
        'js/owl.carousel.min.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
