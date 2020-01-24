<?php

namespace app\widgets\memadEmployee;

use yii\base\Exception;
use yii\base\Model;
use yii\base\Widget;
use yii\helpers\Html;
use app\widgets\memadEmployee\assets\MemadEmployeeAsset;

class MemadEmployeeWidget extends Widget {

    public $wrapClass;
    public $model;

    protected function hasModel() {
        return $this->model instanceof Model;
    }

    public function init() {
        parent::init();
        
        if (!isset($this->model)) return '';
        
        MemadEmployeeAsset::register(\Yii::$app->view);
    }

    public function run() {
        if (!$this->hasModel()) {
            throw new Exception('Model must be set');
        }

        return $this->render('memadEmployee', [
            'wrapClass' => $this->wrapClass,
            'model' => $this->model,
        ]);
    }

}
