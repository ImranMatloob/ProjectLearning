<?php

use app\models\Inbox;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\InboxSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Inboxes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inbox-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Inbox', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php var_dump($dataProvider); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'inbox_id',
            'sender_id',
            'receiver_id',
            'last_message_time',
            'created_at',
            'message_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Inbox $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'inbox_id' => $model->inbox_id]);
                 }
            ],
        ],
    ]); ?>


</div>
