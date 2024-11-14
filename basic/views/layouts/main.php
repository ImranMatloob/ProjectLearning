<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">


<?php $this->beginBody() ?>

<div class="webPage">

    <header id="header">
        <div class="navbarContainer">
            <div class="navbarContainer1">
                <?php
                NavBar::begin([
                    'brandLabel' => 'FootballFrenzie',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => ['class' => 'navbar-expand-md', 'style' => 'background-color: #808080;'],

                ]);

                echo Nav::widget
                ([
                    'options' => ['class' => 'navbar-nav'],
                    'items' => Yii::$app->user->isGuest ?
                        [

                            ['label' => 'User',
                                'items' =>
                                    [
                                        ['label' => 'User', 'url' => ['BackendUsers/index']],
                                        "<div class='dropdown-divider'></div>",
                                        ['label' => 'Student', 'url' => ['/student/index']],


                                    ],
                            ],
                            ['label' => 'Teacher', 'url' => ['/teacher/index']],
                            ['label' => 'Course', 'url' => ['/course/index']],
                            ['label' => 'Login', 'url' => ['/site/login']]

                        ] :
                        [
                            ['label' => '<span class="material-symbols-outlined" id="accountLogo" >account_circle</span>',
                                'encode' => false,
                                'items' =>
                                    [
                                        ['label' => 'My Profile', 'url' => ['backend-users/view',  'id' => Yii::$app->user->id]],
                                        "<div class='dropdown-divider'></div>",
                                        ['label' => 'Student', 'url' => ['/student/index']],
                                    ],
                            ],

                            '<li class="nav-item">'
                            . Html::beginForm(['/site/logout'])
                            . Html::submitButton(
                                '<span class="material-symbols-outlined">logout</span> ',
                                ['class' => 'nav-link btn btn-link logout','id' => 'logoutLogo', 'encode' => false]
                            )
                            . Html::endForm()
                            . '</li>'



                        ]
                ]);

                NavBar::end();
                ?>
            </div>
        </div>
    </header>



    <div class="container">
        <main id="main" class="flex-shrink-0" role="main">
            <div class="main-con">
                <?php if (!empty($this->params['breadcrumbs'])): ?>
                    <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
                <?php endif ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>
    </div>



    <footer id="footer" class="mt-auto py-3 bg-light">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </footer>

    <!-- Flash message auto-close script -->
    <script>
        $(document).ready(function() {


            setTimeout(function()
            {
                $('.alert').fadeOut('slow', function ()
                {
                    $(this).remove();
                });
            },5000);
            $(document).on('click','.alert', function ()
        {
            $(this).remove();
        });
            $(document).on('mouseenter', '.alert', function ()
            {
                $(this).addClass('cursor-pointer');
            }).on('mouseleave', '.alert', function ()
            {
                $(this).removeClass('cursor-pointer');
            });
        });
    </script>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


</div>
