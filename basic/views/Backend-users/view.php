<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\BackendUsers $model */

\yii\web\YiiAsset::register($this);
?>
<div class="backend-users-view">


    <div class="backend-users-view-secondBoarder">

        <?php
        $this->title = $model->username;
        $this->params['breadcrumbs'][] = ['label' => 'Backend Users', 'url' => ['index']];
        $this->params['breadcrumbs'][] = $this->title;
        ?>

        <div class="backendTitle">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>


        <div class="backendProfile">
            <img class = "BackendProfilePictureInPost" src="<?= Yii::getAlias('@web') . $model->photo ?>" alt="Profile Picture" height="170" width="170">

        </div>

        <div class="container text-center">
            <div class="backendRow1">
                <div class="backendCol">
                    <p>Username</p>
                </div>
                <div class="backendCol1">
                    <?=$model->username?>
                </div>

                    <div class="backendCol">
                        <p>Email</p>

                    </div>
                    <div class="backendCol1">
                        <?=$model->email?>
                    </div>


                    <div class="backendCol">
                        <p>Role</p>
                    </div>
                    <div class="backendCol1">
                        <?=$model->role?>
                    </div>


                    <div class="backendCol">
                        <p>Created</p>
                    </div>
                    <div class="backendCol1">
                        <?=$model->created_at?>
                    </div>

            </div>

            <div class="backendButtons">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>



        </div>



    </div>
</div>
