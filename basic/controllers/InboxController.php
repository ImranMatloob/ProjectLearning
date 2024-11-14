<?php

namespace app\controllers;

use app\models\Chat1;
use app\models\Inbox;
use app\models\InboxSearch;
use Yii;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InboxController implements the CRUD actions for Inbox model.
 */
class InboxController extends Controller
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
     * Lists all Inbox models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new InboxSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inbox model.
     * @param int $inbox_id Inbox ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($inbox_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($inbox_id),
        ]);
    }

    /**
     * Creates a new Inbox model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws Exception
     */
    public function actionCreate($receiverId = null)
    {
        $model = new Inbox();
        $chatModel = new Chat1();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $chatModel->load($this->request->post())) {
                // Set sender_id for both models
                $model->sender_id = Yii::$app->user->id;
                $model->receiver_id = $receiverId;
                $model->created_at = date('Y-m-d H:i:s');
                $model->last_message_time = date('Y-m-d H:i:s');

                $chatModel->sender_id = Yii::$app->user->id;
                $chatModel->is_read = 0;
                $chatModel->created_at = date('Y-m-d H:i:s');

                // Start a transaction
                $transaction = Yii::$app->db->beginTransaction();

                try {
                    // Save the inbox first
                    if ($model->save()) {
                        // IMPORTANT: Set the inbox_id after the inbox is saved
                        $chatModel->inbox_id = $model->inbox_id;

                        // Now save the chat message
                        if ($chatModel->save()) {
                            $transaction->commit();
                            return $this->redirect(['site/index']);
                        } else {
                            Yii::$app->session->setFlash('error', 'Error saving chat message');
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'Error saving inbox');
                    }

                    $transaction->rollBack();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            }
        }


        return $this->render('create', [
            'model' => $model,
            'chatModel' => $chatModel,
            'receiverId' => $receiverId,
        ]);
    }
    /**
     * Updates an existing Inbox model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $inbox_id Inbox ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($inbox_id)
    {
        $model = $this->findModel($inbox_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'inbox_id' => $model->inbox_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Inbox model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $inbox_id Inbox ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($inbox_id)
    {
        $this->findModel($inbox_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Inbox model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $inbox_id Inbox ID
     * @return Inbox the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($inbox_id)
    {
        if (($model = Inbox::findOne(['inbox_id' => $inbox_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
