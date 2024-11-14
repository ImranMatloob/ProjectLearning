<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Posts $model*/
/** @var array $testArray */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>



<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>



<!--    --><?php //= DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'id',
//            'user_id',
//            'title',
//            'content:ntext',
//            'status',
//            'created_at',
//            'updated_at',
//            'published_at',
//        ],
//    ]) ?>

</div>
<div class="infoContainer">
    <p>
        <?= $model['content']?>
    </p>
</div>

<div class="buttonBox">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>

