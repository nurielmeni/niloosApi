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

class SiteController extends MemadController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
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
        if ($this->serachFormModel->load(Yii::$app->request->post())) {
            $this->view->params['requestedRout'] = 'site-jobs';
            return $this->render('jobs', ['jobs' => $this->serachFormModel->search()]);
        }
        
        return $this->render('index');
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
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
                // Fields: jobId, jobTitle, cvFile
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
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionEmployers()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('employers', [
            'model' => $model,
        ]);
    }

    
    /**
     * Displays Jobs page.
     *
     * @return string
     */
    public function actionJobs()
    {
        if ($this->serachFormModel->load(Yii::$app->request->post())) {
            return $this->render('jobs', [
                'jobs' => $this->serachFormModel->search(),
                'anchor' => 'search-result',
            ]);
        }
        
        return $this->render('jobs', ['jobs' => []]);
    }
    
    /**
     * Displays Jobs page.
     *
     * @return string
     */
    public function actionJob($jobId)
    {
        if ($this->serachFormModel->load(Yii::$app->request->post())) {
            return $this->render('jobs', [
                'jobs' => $this->serachFormModel->search(),
                'anchor' => 'job-details',
            ]);
        }
        
        $model = new \app\models\Job(['jobId' => $jobId]);
        
        return $this->render('job', ['job' => $model->job]);
    }
    
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $employees = Staff::find()->all();
        return $this->render('about', ['employees' => $employees]);
    }
        
    /**
     * Login action.
     *
     * @return Response|string
    */     
    public function actionLogin()
    {
        $this->layout = 'secure';
        
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/staff/index');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    /**
     * Logout action.
     *
     * @return Response
    */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
}
