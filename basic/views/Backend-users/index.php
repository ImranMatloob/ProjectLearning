<?php

use app\models\BackendUsers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BackendUsersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Backend Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backend-users-index">

    <div class="ackend-users-index-secondBoarder">


    </div>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Backend Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            'password',
            'photo',
            //'role',
            //'created_at',
            //'updated_at',
            //'authKey',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BackendUsers $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
