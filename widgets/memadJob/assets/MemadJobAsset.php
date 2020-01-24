<?php

namespace app\widgets\memadJob\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class MemadJobAsset extends AssetBundle {

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
    public $sourcePath = '@app/widgets/memadJob/assets';
    public $css = [
        'css/memadJob.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
