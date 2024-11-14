<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Chat1 $model */

/** @var yii\widgets\ActiveForm $form */
?>

<div class="chat1-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inbox_id')->textInput() ?>

    <?= $form->field($model, 'sender_id')->textInput() ?>

    <?= $form->field($model, 'message_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_read')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
