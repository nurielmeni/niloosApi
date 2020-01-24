<?php

namespace app\widgets\memadSubmit\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class MemadSubmitAsset extends AssetBundle {

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
    public $sourcePath = '@app/widgets/memadSubmit/assets';
    public $css = [
        'css/memadSubmit.css',
    ];
    public $js = [
        'js/ajaxForm.js',
        'js/ajaxModalPopup.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
