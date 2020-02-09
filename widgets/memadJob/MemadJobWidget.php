<?php

namespace app\widgets\memadJob;

use yii\base\Exception;
use yii\base\Model;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\memadJob\assets\MemadJobAsset;

class MemadJobWidget extends Widget {

    public $wrapClass;
    public $direction = '';
    public $jobUrl;
    public $showHeaders = false;
    public $job = [];
    public $submitUrl = '/site/apply';

    protected function hasModel() {
        return $this->model instanceof Model;
    }

    public function init() {
        parent::init();
        
        if (!is_array($this->job)) return '';
        if (!isset($this->jobUrl)) $this->jobUrl = Url::to('/site/job/');

        MemadJobAsset::register(\Yii::$app->view);
    }
    
    public function run() {
        return $this->render('memadJob', [
            'wrapClass' => $this->wrapClass,
            'direction' => $this->direction,
            'jobUrl' => $this->jobUrl,
            'showHeaders' => $this->showHeaders,
            'job' => $this->job,
            'submitUrl' => $this->submitUrl,
        ]);
    }

}
