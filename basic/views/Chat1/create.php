<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Chat1 $model */

$this->title = 'Create Chat1';
$this->params['breadcrumbs'][] = ['label' => 'Chat1s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chat1-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
