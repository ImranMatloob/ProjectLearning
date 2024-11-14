<?php

use app\models\Location;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Posts $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $backEndUser */
?>

<div class="backend-users-view">


    <div class="backend-users-view-secondBoarder">

        <?php
        //            $user = $BackEndModel->findModel($model->user_id);
        $this->params['breadcrumbs'][] = ['label' => 'Backend Users', 'url' => ['index']];
        $this->params['breadcrumbs'][] = $this->title;
        ?>

        <div class="backendTitle">
            <h1><?= Html::encode($backEndUser->username) ?></h1>
        </div>

        <?php $form = ActiveForm::begin(); ?>

        <div class="backendProfile">
            <img class = "BackendProfilePictureInPost" src="<?= Yii::getAlias('@web') . $backEndUser['photo'] ?>" alt="Profile Picture" height="170" width="170">

        </div>

        <div class="container text-center">
            <div class="backendRow1">
                <div class="backendCol">
                    <p>and you can change back?</p>
                </div>
                <div class="backendCol1">
                    <?= $form->field($model, 'title',
                        [
                            'template' => '{input}'
                        ])->textInput(['maxlength' => true, 'placeholder' => 'enter the name via VIM!', 'class' => 'nameBar']) ?>
                </div>

                <div class="backendCol">
                    <p>Post Description</p>

                </div>
                <div class="backendCol1">
                    <?= $form->field($model, 'content',
                        [
                            'template' => '{input}'
                        ])->textInput(['maxlength' => true,'class' => 'nameBar']) ?>
                </div>


                <div class="backendCol">
                    <p>Location</p>
                </div>
                <div class="backendCol1">
                    <?= $form->field($model, 'location_id',
                        [
                            'template' => '{input}'
                        ])->dropDownList(
                        Arrayhelper::map(Location::find()->all(), 'id', 'venue', 'city'),
                        ['prompt' => 'Select Location', 'class' => 'dropDownBox']) ?>

                </div>

                <div class="backendCol">
                    <p>Set Status</p>
                </div>
                <div class="backendCol1">
                    <?= $form->field($model, 'status',
                        [
                            'template' => '{input}'
                        ])->dropDownList([ 'draft' => 'Draft', 'published' => 'Public', 'archived' => 'Private'],['prompt' => 'Please provide more information', 'class' => 'dropDownBox']) ?>
                </div>

            </div>

            <div class="backendButtons">

                <div class="form-group">
                    <?= Html::a('Back', ['site/index'], ['class' => 'btn btn-success']) ?>
                    <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
                </div>

            </div>

            <?php ActiveForm::end(); ?>


        </div>



    </div>
</div>
