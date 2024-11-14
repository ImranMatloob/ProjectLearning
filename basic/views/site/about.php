<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'not anymore';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       As i understand it, the controller points here by using the action function..
        that funtion is called actionAbout and to returns 'about'

    </p>

    <code><?= __FILE__ ?></code>
</div>
