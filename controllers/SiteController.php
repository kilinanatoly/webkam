<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use Madcoda;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
     * @inheritdoc
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
        $youtube = new Madcoda\Youtube(array('key' => 'AIzaSyCJDDnFyY_4DZKXUXKtYbvjmGlB0w_q6uo'));
        $videos1 = NULL;
        $videos2 = NULL;
        if (Yii::$app->request->post('youtubeSearch')){
            $videos1 = $youtube->searchVideos(Yii::$app->request->post('youtubeSearch'), 20,'date');
        }
        if (Yii::$app->request->post('youtubeSearch2')){
            $videos2 = $youtube->searchVideos(Yii::$app->request->post('youtubeSearch2'), 20,'viewcount');
        }
        return $this->render('index',[
            'videos1'=>$videos1,
            'videos2'=>$videos2,
        ]);
    }
    public function actionYoutubeAjax(){
        if (Yii::$app->request->post('videoId')){
            $youtube = new Madcoda\Youtube(array('key' => 'AIzaSyCJDDnFyY_4DZKXUXKtYbvjmGlB0w_q6uo'));
            $video = $youtube->getVideoInfo(Yii::$app->request->post('videoId'));
            $html = $video->player->embedHtml;
            return $html;
        }
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
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

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
