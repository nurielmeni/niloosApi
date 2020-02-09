<?php

namespace app\widgets\freeSearch;

use yii\base\Exception;
use yii\base\Model;
use yii\base\Widget;
use yii\helpers\Html;
use app\widgets\freeSearch\assets\FreeSearchAsset;

class FreeSearchWidget extends Widget {

    public $name;
    public $wrapClass;
    public $model;
    public $prompt = false;
    public $inline = false;
    public $submitLabel = 'OK';
    public $action;
    private $view;

    protected function hasModel() {
        return $this->model instanceof Model;
    }

    public function init() {
        parent::init();
                
        FreeSearchAsset::register(\Yii::$app->view);

        $this->view = $this->getView();
        $this->name = !empty($this->name) ?: 'f' . rand();
        $this->prompt = empty($this->prompt) ? false : $this->prompt;
    }

    public function run() {
        if (!$this->hasModel()) {
            throw new Exception('Model must be set');
        }

        return $this->render('freeSearch', [
            'name' => $this->name,
            'wrapClass' => $this->wrapClass,
            'model' => $this->model,
            'prompt' => $this->prompt,
            'inline' => $this->inline,
            'submitLabel' => $this->submitLabel,
            'action' => $this->action,
            'view' => $this->view,
        ]);
    }

}
