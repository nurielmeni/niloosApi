<?php

namespace app\widgets\customSelect\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class CustomSelectAsset extends AssetBundle {

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
    public $sourcePath = '@app/widgets/customSelect/assets';
    public $css = [
        'css/nice-select.css',
    ];
    public $js = [
        'js/jquery.nice-select.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
