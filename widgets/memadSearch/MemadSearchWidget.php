<?php

namespace app\widgets\memadSearch;

use yii\base\Exception;
use yii\base\Model;
use yii\base\Widget;
use yii\helpers\Html;
use app\widgets\memadSearch\assets\MemadSearchAsset;

class MemadSearchWidget extends Widget {

    public $name;
    public $wrapClass;
    public $model;
    public $intro = false;
    public $inline = false;
    public $submitLabel = 'מצא לי משרה';
    public $action;
    private $view;

    protected function hasModel() {
        return $this->model instanceof Model;
    }

    public function init() {
        parent::init();
        
        if (!isset($this->model)) return '';
        
        MemadSearchAsset::register(\Yii::$app->view);

        $this->view = $this->getView();
        $this->name = !empty($this->name) ?: 'f' . rand();
        $this->intro = empty($this->intro) ? false : $this->intro;
    }

    public function run() {
        if (!$this->hasModel()) {
            throw new Exception('Model must be set');
        }

        return $this->render('memadSearch', [
            'name' => $this->name,
            'wrapClass' => $this->wrapClass,
            'model' => $this->model,
            'intro' => $this->intro,
            'inline' => $this->inline,
            'submitLabel' => $this->submitLabel,
            'action' => $this->action,
            'view' => $this->view,
        ]);
    }

}
