<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Inbox $model */
/** @var app\models\Chat1 $chatModel */
/** @var int $receiverId */

$this->title = 'Create Inbox';
$this->params['breadcrumbs'][] = ['label' => 'Inboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inbox-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'chatModel' => $chatModel,  // Add this line
        'receiverId' => $receiverId,
    ]) ?>

</div>