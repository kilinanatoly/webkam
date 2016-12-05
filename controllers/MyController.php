<?php

namespace app\controllers;

use Madcoda;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class MyController extends Controller
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
        $this->layout = 'custom1';
        $youtube = new Madcoda\Youtube(array('key' => 'AIzaSyCJDDnFyY_4DZKXUXKtYbvjmGlB0w_q6uo'));
        $videos1 = NULL;
        $videos2 = NULL;
        if (Yii::$app->request->post('youtubeSearch')) {
            $videos1 = $youtube->searchVideos(Yii::$app->request->post('youtubeSearch'), 20, 'date');
            foreach ($videos1 as $key => $value) {
                $mas[] = $value->id->videoId;
            }
            $videosInfo = $youtube->getVideosInfo($mas);
            usort($videosInfo, function ($a, $b) {
                return ($a->statistics->viewCount - $b->statistics->viewCount);
            });
            $videos2 = array_reverse($videosInfo);

        }
        return $this->render('index', [
            'videos1' => $videos1,
            'videos2' => $videos2,
        ]);
    }

    public function actionYoutubeAjax()
    {
        if (Yii::$app->request->post('videoId')) {
            $youtube = new Madcoda\Youtube(array('key' => 'AIzaSyCJDDnFyY_4DZKXUXKtYbvjmGlB0w_q6uo'));
            $video = $youtube->getVideoInfo(Yii::$app->request->post('videoId'));
            $html = $video->player->embedHtml;
            return $html;
        }
    }
}
