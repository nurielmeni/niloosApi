<?php

namespace app\controllers;

use Yii;

class ErrorController extends \yii\web\Controller
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
    
    
   
