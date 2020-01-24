<?php

namespace app\controllers;

use app\models\SearchForm;

class MemadController extends \yii\web\Controller
{
    protected $serachFormModel;
    
    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
        $this->serachFormModel = new SearchForm();
        $this->view->params['serachFormModel'] = $this->serachFormModel;
        $this->view->params['requestedRout'] = empty($module->requestedRoute) ? $this->id . '-' . $this->defaultAction : str_replace('/', '-', $module->requestedRoute);
    }
}
