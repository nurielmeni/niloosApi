<?php

namespace app\widgets\memadEmployee\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class MemadEmployeeAsset extends AssetBundle {

    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];
    public $sourcePath = '@app/widgets/memadEmployee/assets';
    public $css = [
        'css/memadEmployee.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
