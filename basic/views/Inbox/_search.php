<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\InboxSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="inbox-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'inbox_id') ?>

    <?= $form->field($model, 'sender_id') ?>

    <?= $form->field($model, 'receiver_id') ?>

    <?= $form->field($model, 'last_message_time') ?>

    <?= $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
