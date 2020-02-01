<?php

namespace app\widgets\freeSearch\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FreeSearchAsset extends AssetBundle {

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
    public $sourcePath = '@app/widgets/freeSearch/assets';
    public $css = [
        'css/freeSearch.css',
    ];
    public $js = [
//        'js/freeSearch.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
