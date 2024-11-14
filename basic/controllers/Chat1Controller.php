<?php

namespace app\controllers;

use app\models\Chat1;
use app\models\Chat1Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Chat1Controller implements the CRUD actions for Chat1 model.
 */
class Chat1Controller extends Controller
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
     * Lists all Chat1 models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new Chat1Search();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Chat1 model.
     * @param int $message_id Message ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($message_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($message_id),
        ]);
    }

    /**
     * Creates a new Chat1 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Chat1();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'message_id' => $model->message_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Chat1 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $message_id Message ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($message_id)
    {
        $model = $this->findModel($message_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'message_id' => $model->message_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Chat1 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $message_id Message ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($message_id)
    {
        $this->findModel($message_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Chat1 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $message_id Message ID
     * @return Chat1 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($message_id)
    {
        if (($model = Chat1::findOne(['message_id' => $message_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
