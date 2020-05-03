<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SearchForm;
use \app\components\Niloos;
use app\models\Staff;
use yii\web\UploadedFile;
use app\models\ApplyForm;

class SiteController extends \yii\web\Controller
{
    /**
     * @var bool See details {@link \yii\web\Controller::$enableCsrfValidation}.
     */
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    'Origin' => ['*'], 
                    'Accept' => ['Origin', 'X-Requested-With', 'Content-Type', 'Accept'], 
                    'Access-Control-Request-Method' => ['GET', 'POST'], 
                    'Access-Control-Request-Headers' => ['*'], 
                    'Access-Control-Allow-Credentials' => null, 
                    'Access-Control-Max-Age' => 86400, 
                    'Access-Control-Expose-Headers' => []
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {        
        $this->layout = 'vue';
        return $this->render('index.html');
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
    
    /**
     * Displays Jobs page.
     *
     * @return string
     */
    public function actionJobs()
    {
        $searchModel = new SearchForm();
        
//        $searchModel = new SearchForm([
//            'location' => '',
//            'profession' => '',
//            'suplierId' => '',
//            'freetext' => '',
//        ]);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($searchModel->load(Yii::$app->request->get())) {
            return $searchModel->search(true);
        }
        
        return $searchModel->search(true);
    }
    
    /**
     * Displays Jobs page.
     *
     * @return string
     */
    public function actionJob($jobId)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new \app\models\Job(['jobId' => $jobId]);
        
                
        return $model->getJob();
    }
}
