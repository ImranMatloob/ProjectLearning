<?php

use app\models\Location;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Location $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $backEndUser */
?>

<div class="formSize">

<!--    --><?php //$form = ActiveForm::begin(); ?>
<!---->
<!--    --><?php //= $form->field($model, 'venue')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'address_line_1')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'address_line_2')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'postcode')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?php //= $form->field($model, 'parking_info')->textarea(['rows' => 6]) ?>
<!---->
<!--    <div class="form-group">-->
<!--        --><?php //= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
<!--    </div>-->
<!---->
<!--    --><?php //ActiveForm::end(); ?>


    <div class="backend-users-view">


        <div class="backend-users-view-secondBoarder">

            <?php
            $this->params['breadcrumbs'][] = ['label' => 'Backend Users', 'url' => ['index']];
            $this->params['breadcrumbs'][] = $this->title;
            ?>

            <?php $form = ActiveForm::begin(); ?>


            <div class="container text-center">
                <div class="backendRow1">
                    <div class="backendCol">
                        <p>Venue</p>
                    </div>
                    <div class="backendCol1">
                        <?= $form->field($model, 'venue',
                            [
                                'template' => '{input}'
                            ])->textInput(['maxlength' => true, 'placeholder' => 'Please enter the Venue name', 'class' => 'nameBar']) ?>
                    </div>

                    <div class="backendCol">
                        <p>Address</p>

                    </div>
                    <div class="backendCol1">
                        <?= $form->field($model, 'address_line_1',
                            [
                                'template' => '{input}'
                            ])->textInput(['maxlength' => true, 'placeholder' => 'Please enter the Address', 'class' => 'nameBar']) ?>
                    </div>


                    <div class="backendCol">
                        <p>City</p>
                    </div>
                    <div class="backendCol1">
                            <?= $form->field($model, 'city',[ 'template' => '{input}'])->textInput(['maxlength' => true, 'placeholder' => 'Please enter the Address Line 1', 'class' => 'nameBar']) ?>
                    </div>

                    <div class="backendCol">
                        <p>Postcode</p>
                    </div>
                    <div class="backendCol1">
                    <?= $form->field($model, 'postcode',
                        [
                            'template' => '{input}'
                        ])->textInput(['maxlength' => true, 'placeholder' => 'Please enter the Postcode', 'class' => 'nameBar']) ?>
                    </div>

                <div class="backendCol">
                    <p>Country</p>
                </div>
                    <div class="backendCol1">
                <?= $form->field($model, 'country',
                    [
                        'template' => '{input}'
                    ])->textInput(['maxlength' => true, 'placeholder' => 'Please enter your Country', 'class' => 'nameBar']) ?>
                    </div>


                </div>

                <div class="backendButtons">

                    <div class="form-group">
                        <?= Html::a('Back', ['site/index'], ['class' => 'btn btn-success']) ?>
                        <?= Html::submitButton('Create',  ['class' => 'btn btn-success', 'id' => 'createButton']) ?>
                    </div>

                </div>

                <?php ActiveForm::end(); ?>


            </div>



        </div>
    </div>
</div>
