<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Chat1 $model */

$this->title = 'Update Chat1: ' . $model->message_id;
$this->params['breadcrumbs'][] = ['label' => 'Chat1s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->message_id, 'url' => ['view', 'message_id' => $model->message_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chat1-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
