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
                        <p>Post Title</p>
                    </div>
                    <div class="backendCol1">
                            <?= $form->field($model, 'title',
                                [
                                        'template' => '{input}'
                                ])->textInput(['maxlength' => true, 'placeholder' => 'Why are you not working? name', 'class' => 'nameBar']) ?>
                    </div>

                    <div class="backendCol">
                        <p>Post Description</p>

                    </div>
                    <div class="backendCol1">
                        <?= $form->field($model, 'content',
                            [
                                'template' => '{input}'
                            ])->textInput(['maxlength' => true, 'placeholder' => 'Please provide more information', 'class' => 'nameBar']) ?>
                    </div>


                    <div class="backendCol">
                        <p>Location</p>
                    </div>
                    <div class="backendCol1">

                        <?php
                        $location = Arrayhelper::map(Location::find()->all(), 'id', 'venue', 'city');
                        $location['add_more'] = '+Add New Location';?>


                        <?= $form->field($model, 'location_id',
                            [
                                'template' => '{input}'
                            ])->dropDownList($location,
                            ['prompt' => 'Select Location', 'class' => 'dropDownBox']);

                        ?>

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
                            <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
                        </div>

                </div>

                    <?php ActiveForm::end(); ?>


            </div>



        </div>
        <?php
        $redirectUrl = URL::to(['location/create']);
        $dropDownAddLocation =
            <<<JS
                                     $(document).ready(function ()
                                     {
                                         $('.dropDownBox').on('change',function ()
                                         {
                                             if($(this).val() === 'add_more')
                                                 {
                                                     window.location.href = '$redirectUrl';
                                                 }
                                         });
                                     });
            JS;
        $this->registerJs($dropDownAddLocation);

        ?>
    </div>
