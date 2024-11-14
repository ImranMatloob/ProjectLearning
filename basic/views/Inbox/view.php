<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Inbox $model */

$this->title = $model->inbox_id;
$this->params['breadcrumbs'][] = ['label' => 'Inboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="inbox-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'inbox_id' => $model->inbox_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'inbox_id' => $model->inbox_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'inbox_id',
            'sender_id',
            'receiver_id',
            'last_message_time',
            'created_at',
        ],
    ]) ?>

</div>
