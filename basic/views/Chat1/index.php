<?php

use app\models\Chat1;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Chat1Search $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Chat1s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chat1-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Chat1', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'message_id',
            'inbox_id',
            'sender_id',
            'message_text:ntext',
            'is_read',
            //'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Chat1 $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'message_id' => $model->message_id]);
                 }
            ],
        ],
    ]); ?>


</div>
