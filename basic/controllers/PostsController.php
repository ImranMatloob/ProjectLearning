<?php

namespace app\controllers;

use app\models\Location;
use app\models\Posts;
use app\models\PostsSearch;
use app\models\backendUsers;
use app\models\UsersSearch;
use Yii;
use yii\debug\models\search\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Posts models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Posts model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $testArray = [1,2,3,4,5];
        return $this->render('view', [
            'model' => $this->findModel($id),
            'testArray' => $testArray
        ]);
    }

    /**
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Posts();
        $model->user_id = Yii::$app->user->id;
        $backendUseers = backendUsers::findOne(['id' => $model->user_id]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['site/index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'backEndUser' => $backendUseers,
        ]);

    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $backendUseers = backendUsers::findOne(['id' => $model->user_id]);



        if($model->user_id === Yii::$app->user->id)
        {
            if($this->request->isPost)
            {
                if ($model->load($this->request->post()) && $model->save()) {
                    Yii::$app->session->setFlash('success', 'The post has been updated sucessfully.');
                    return $this->redirect(['site/index']);
                }
            }


            return $this->render('update', [
                'model' => $model,
                'backEndUser' => $backendUseers,
            ]);
        }
        Yii::$app->session->setFlash('error', 'You do not have permission to update this post.');
        return $this->redirect(['site/index']);
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

            if($model->user_id === Yii::$app->user->id)
            {
                $this->findModel($id)->delete();
                Yii::$app->session->setFlash('success', 'The post has been deleted sucessfully.');
                return $this->redirect(['site/index']);
            } else
                Yii::$app->session->setFlash('error', 'You do not have permission to delete this post.');

        return $this->redirect(['site/index']);

    }

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
