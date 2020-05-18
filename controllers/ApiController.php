<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\SearchForm;
use yii\web\UploadedFile;
use app\models\ApplyForm;
use yii\web\BadRequestHttpException;

class ApiController extends \yii\web\Controller
{
    private $project;
    
    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public function beforeAction($action)
    {
        $this->project = Yii::$app->request->get('project');
        // your custom code here, if you want the code to run before action filters,
        // which are triggered on the [[EVENT_BEFORE_ACTION]] event, e.g. PageCache or AccessControl

        if (!parent::beforeAction($action)) {
            return false;
        }

        // other custom code here
        if (!$this->project) {
            throw new BadRequestHttpException('You need to provide the project in your request.');
        }

        return true; // or false to not run the action
    }    
    
    public function actionJob($jobId)
    {
        $model = new \app\models\Job(['jobId' => $jobId]);
        
                
        return $model->getJob();
    }

    public function actionJobs()
    {
        $searchModel = new SearchForm();
        
//        $searchModel = new SearchForm([
//            'location' => '',
//            'profession' => '',
//            'suplierId' => '',
//            'freetext' => '',
//        ]);

        if ($searchModel->load(Yii::$app->request->get())) {
            return $searchModel->search(true);
        }
        
        return $searchModel->search(true);
    }

    public function actionApply()
    {
        $request = Yii::$app->request;
        
        //if ($request->isAjax) {
            $model = new ApplyForm();
            if ($request->isPost) {
                // Fields: jobId, jobCode, jobTitle, cvFile
                $post = $request->post();
                $model->load(['ApplyForm' => $post], 'ApplyForm');
                $model->cvFile = UploadedFile::getInstance($model, 'cvFile');
                if ($model->cvFile) {
                    $model->upload();
                }
                if ($model->sendMail(Yii::$app->params['cvWebMail'])) {
                    // file is uploaded successfully send mail
                    return 'File uploaded successfully and email sent';
                }
            }

            return 'OK';
        //}
    }
}
