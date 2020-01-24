<?php

namespace app\widgets\memadLogoNav\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class MemadLogoNavAsset extends AssetBundle {

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
    public $sourcePath = '@app/widgets/memadLogoNav/assets';
    public $css = [
        'css/memadLogoNav.css',
    ];
//    public $js = [
//        'js/jquery.nice-select.min.js',
//    ];
//    public $depends = [
//        'yii\web\JqueryAsset',
//    ];

}
