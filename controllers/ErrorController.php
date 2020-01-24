<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class ErrorController extends yii\web\Controller
{
    public $layout =  'error';
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionNiloosError()
    {
        return $this->render('niloos-error');
    }
    
}
    
    
   
