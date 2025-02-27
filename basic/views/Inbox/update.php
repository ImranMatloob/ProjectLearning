<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Inbox $model */

$this->title = 'Update Inbox: ' . $model->inbox_id;
$this->params['breadcrumbs'][] = ['label' => 'Inboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->inbox_id, 'url' => ['view', 'inbox_id' => $model->inbox_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inbox-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
