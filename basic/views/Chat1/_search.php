<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Chat1Search $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="chat1-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'message_id') ?>

    <?= $form->field($model, 'inbox_id') ?>

    <?= $form->field($model, 'sender_id') ?>

    <?= $form->field($model, 'message_text') ?>

    <?= $form->field($model, 'is_read') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
