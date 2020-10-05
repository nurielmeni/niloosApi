<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\base\Theme;
use app\models\SearchForm;
use yii\web\UploadedFile;
use app\models\ApplyForm;
use app\models\Settings;
use yii\web\BadRequestHttpException;

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
    
    private function switchTheme($theme) {
        if (Yii::$app->view->theme !== $theme) {
            Yii::$app->view->theme = new Theme([
                'basePath' => '@app/themes/' . $theme,
                'baseUrl' => '@web/themes/' . $theme,
                'pathMap' => [
                    '@app/views' => '@app/themes/' . $theme,
                ],
            ]);
        }
    }
    


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($project)
    {
        if (!Settings::findOne(['project' => $project])) {
            throw new BadRequestHttpException('Project does not exist: ' . $project);
        }
        
        // Set the theme based on the project
        $this->switchTheme($project);
        $this->layout = 'vue';
        return $this->render('index.html');
    }
}
