<?php

namespace app\widgets\socialShare\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class SocialShareAsset extends AssetBundle {

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
    public $sourcePath = '@app/widgets/socialShare/assets';
    public $css = [
        'css/socialShare.css',
    ];
    public $js = [
        'js/script.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
