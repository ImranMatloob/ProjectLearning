<?php

namespace app\controllers;

use app\models\backendUsers;
use app\models\Location;
use app\models\PostsSearch;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Posts;
use app\models\User;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
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
        $latestPosts = Posts::find()->orderBy(['created_at' =>SORT_DESC])->all();
        $users = BackendUsers::find()->all();
        $location = Location::find()->orderBy(['id' => SORT_DESC])->all();
        $postData = $this->getPostInformation($latestPosts,$users, $location);

        $passingSimpleArray = [1,2,3,4,5];

        //gets the query:
        $query = Yii::$app->request->get('query');

        //serach
        $postSearch = new PostsSearch();
        $data = $postSearch->search(Yii::$app->request->queryParams);
        $searchQuery = $data->getModels();
        $searchParams = Yii::$app->request->get('PostsSearch');

//        $locationid = $this->getLocation($)

        if ($searchParams && isset($searchParams['title'])) {
            $searchParams = Html::encode($searchParams['title']);
            $searchResult = $postSearch->search(['PostsSearch' => $searchParams]);
            $searchQuery = $searchResult->getModels();
            $postData = $this->getPostInformation($searchQuery, $users, $location);
        }


        return $this->render('index',[
            'String' => 'Imran is the best',
            'latestPosts' => $latestPosts,
            'users' => $users,
            'postData' => $postData,
            'searchQuery' => $searchQuery,
            'postSearch' => $postSearch,
            'location' => $location
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
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

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    //functions:


    function getUserPhotoUrl($userId, $users) {
        foreach ($users as $user)
        {
            if ($user->id === $userId)
            {
                return $user->photo;
            }
        }
        return null;
    }

    function getLocation($locationId, $location)
    {
        foreach ($location as $locations)
        {
            if($locations->id === $locationId)
            {
                return html::encode($locations->venue);
            }
        }
        return html::encode( 'sorry, no location is linked');
    }

    function getLocationPostCode($locationId, $location)
    {
        foreach ($location as $locations)
        {
            if($locations->id === $locationId)
            {
                return html::encode($locations->postcode);
            }
        }
        return html::encode( 'sorry, no location is linked');
    }

    function getUserName($userId, $users)
    {
        foreach ($users as $user)
        {
            if($user->id === $userId)
            {
                return html::encode($user->username);
            }
        }
        return null;
    }

//    function getTitle($userId,$users)
//    {
//        foreach ($users as $user)
//        {
//            if($user->id === $userId)
//            {
//                return $user->title;
//            }
//        }
//        return null;
//    }
    function getPostInformation($posts, $users, $location)
    {
        $postData = [];
        foreach ($posts as $post)
        {

            $photo = html::encode($this->getUserPhotoUrl($post->user_id, $users));
            $userName = html::encode($this->getUserName($post->user_id, $users));
            $locationOfpost = html::encode($this->getLocation($post->location_id, $location));
            $locationPostCode = html::encode($this ->getLocationPostCode($post->location_id, $location));
            $postData[] =
                [
                    'content' => $post->content,
                    'photo' => $photo,
                    'userName' => $userName,
                    'title' => $post->title,
                    'postId' => $post->id,
                    'locationVenue' => $locationOfpost,
                    'postcode' => $locationPostCode,
                    'user_id' => $post->user_id
                ];
        }
        return $postData;
    }


}
