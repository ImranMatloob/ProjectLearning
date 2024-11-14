<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Inbox $model */
/** @var yii\widgets\ActiveForm $form */
/** @var app\models\Inbox $receiverId */
/** @var app\models\Chat1 $chatModel */
?>

<div class="inbox-form">
    <?php $form = ActiveForm::begin(); ?>

    <!-- Chat Message field - this is the only visible field -->
    <?= $form->field($chatModel, 'message_text')->textarea(['rows' => 6]) ?>

    <!-- Hidden fields -->
    <?= $form->field($model, 'sender_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
    <?= $form->field($model, 'receiver_id')->hiddenInput(['value' => $receiverId])->label(false) ?>
    <?= $form->field($chatModel, 'sender_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
    <?= $form->field($chatModel, 'is_read')->hiddenInput(['value' => 0])->label(false) ?>

    <?=  $_GET['receiverId'];?>

    <div class="form-group">
        <?= Html::submitButton('Send Message', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>