<?php

namespace app\widgets\memadSubmit;

use yii\base\Model;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\memadSubmit\assets\MemadSubmitAsset;

class MemadSubmitWidget extends Widget {

    public $wrapClass;
    public $name = 'memad-submit';
    public $header = '';
    public $body = '';
    public $footer = '';

    public function init() {
        parent::init();
        
        MemadSubmitAsset::register(\Yii::$app->view);
    }
    
    public function run() {
        return $this->render('memadSubmit', [
            'wrapClass' => $this->wrapClass,
            'name' => $this->name,
            'header' => $this->header,
            'body' => $this->body,
            'footer' => $this->footer,
        ]);
    }

}
