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
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    'Access-Control-Allow-Origin' => '*',
                    // restrict access to
                    'Origin' => ['http://localhost:8080', 'http://10.0.0.12:8080'],
                    // Allow only POST and PUT methods
                    'Access-Control-Request-Method' => ['POST', 'PUT'],
                    // Allow only headers 'X-Wsse'
                    'Access-Control-Request-Headers' => ['X-Wsse'],
                    // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
                    'Access-Control-Allow-Credentials' => true,
                    // Allow OPTIONS caching
                    'Access-Control-Max-Age' => 3600,
                    // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                    'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
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
                    'apply' => ['post'],
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
        return $this->render('index');
    }
    
    public function actionApply()
    {
        $request = Yii::$app->request;
        
        if ($request->isAjax) {
            Yii::$app->assetManager->bundles = [

                'yii\bootstrap\BootstrapPluginAsset' => false,

                'yii\bootstrap\BootstrapAsset' => false,

                'yii\web\JqueryAsset' => false

            ];
            $model = new ApplyForm();
            if ($request->isPost) {
                // Fields: jobId, jobCode, jobTitle, cvFile
                $model->load($request->post(), 'ApplyForm');
                $model->cvFile = UploadedFile::getInstance($model, 'cvFile');
                if ($model->upload() && $model->sendMail(Yii::$app->params['cvWebMail'])) {
                    // file is uploaded successfully send mail
                    return $this->renderAjax('thank');
                }
            }

            return $this->renderAjax('apply', ['model' => $model]);
        }
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
