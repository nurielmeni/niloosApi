<?php

namespace app\widgets\slickCarousel\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class SlickCarouselAsset extends AssetBundle {

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
    public $sourcePath = '@app/widgets/slickCarousel/assets';
    public $css = [
        'css/slick.css',
        'css/slick-theme.css',
    ];
    public $js = [
        'js/slick.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
