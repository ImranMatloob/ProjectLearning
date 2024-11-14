<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/* @var $String string */
/** @var array $latestPosts */
/** @var array $users */
/** @var array $postData */
/** @var array $location */


//'simpleArray' => $passingSimpleArray

/** @var app\models\PostsSearch $postSearch */
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

AppAsset::register($this);

?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Welcome to FootballFrenzie</h1>
        <p> A website designed for getting you a 5-aside game</p>
    </div>

    <div class="guideFunction">
        <div class="search-container">

            <form action="<?= Url::to(['site/index'])?>" method="get">
                <span class="material-symbols-outlined">search</span>
                <?= Html::textInput('PostsSearch[title]', $postSearch->title, ['class' => 'search-input', 'placeholder' => 'Search']) ?>
            </form>
        </div>
        <button type="button" class="btn btn-success" id="greenButton" onclick="window.location.href='<?= Url::to(['posts/create']) ?>'" >Create</button>

    </div>

    </div>

        <div class="body-content">

            <div class="postWrapper">
                <?php foreach ($postData as $post): ?>
                    <div class="post_1">
                        <div class="title">
                            <h2><?= Html::encode($post['title'])?></h2>

                        </div>
                        <div class="blog-wrapper">

                            <div class="userProfile">
                                <div class="picture_post_1">
                                    <img class = "ProfilePictureInPost" src="<?= Yii::getAlias('@web') . $post['photo'] ?>" alt="Profile Picture" height="170" width="170">
                                </div>

                                <div class="username" data-username-id = "<?= $post['user_id']?>">
                                    <div class="profileIcon">
                                        <span class="material-symbols-outlined">person</span>
                                    </div>
                                    <div class="name">
                                        <?= Html::encode($post['userName']) ?>
                                    </div>

                                </div>

                            </div>

                            <div class="text_blog_post">
                                <div class="text_blog_post2">


                                    <div class="textbox">

                                        <p class="textBoxP">
                                        <?= Html::encode($post['content']) ?>, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse in interdum mauris. Sed facilisis
                                        bibendum felis, in consequat neque euismod sit amet. Donec vel velit quis velit ultricies venenatis.
                                        Cras vitae libero felis. Vivamus tempor orci a urna hendrerit, sit amet venenatis nisl consequat.
                                        Proin tristique magna magna, a cursus odio mollis ut.
                                        </p>

                                    </div>


                                    <?php if(Yii::$app->user->id !== $post['user_id']):?>

                                        <div class="viewMoreBox">
                                                <?= Html::a('Sign Up','#' ,['class' => 'btn btn-success signupButton', 'id' => 'buttonB', 'data-username-id' => $post['user_id']]) ?>
                                        </div>

                                    <?php else:?>

                                        <div class="viewMoreBox">
                                            <div class="viewMore">
                                                <?= Html::a('Update',['posts/update', 'id' => $post['postId']])?>
                                                <?= Html::a('Delete', ['posts/delete', 'id' => $post['postId']],['data'=>['confirm' => 'Are you sure you want to delete this post?','method' => 'post']]) ?>
                                            </div>
                                        </div>

                                    <?php endif;?>

                                </div>

                                <div class="mapCOntainer">

                                    <div class="map">
                                        <div class="mapIcon">
                                            <span class="material-symbols-outlined">map</span>
                                        </div>
                                        <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($post['locationVenue'] . ', ' . $post['postcode']) ?>">
                                            <p class="test123"><?= Html::encode($post['locationVenue'])?></p>
                                        </a>
                                    </div>

                                </div>

                            </div>



                        </div>
                    </div>
                <?php endforeach;?>

            </div>

            <?php
            $redirectUrl = URL::to(['location/create']);



            $onClick =
                <<<JS
                                    $(document).ready(function ()
                                                    {
                                                       $(".textbox")
                                                           .hover(function ()
                                                               {
                                                                 $(this).addClass("cursor-pointer");
                                                               }, function ()
                                                                    {
                                                                      $(this).removeClass("cursor-pointer");
                                                                    })


                                                           .click(function() {
                                                               let text = $(this).find(".textBoxP");

                                                               if(!text.hasClass("expanded"))
                                                               {
                                                                   let fullText = text[0].scrollHeight;
                                                                   text.css("height", text.height)
                                                                   text.addClass("expanded");
                                                                   text.css("height", fullText);
                                                               }else
                                                               {
                                                                   text.css("height", "")
                                                                   text.removeClass("expanded")
                                                               }

                                                           });
                                                    });
            JS;
            $this->registerJs($onClick);

            $toUserView = Json::encode(Url::to(['backend-users/view',  'id' => '']));
            $curserPointer =
                <<<JS
                $(document).ready(function () {
                $(".username")

                .hover(function (){ $(this).addClass("cursor-pointer");}, function (){ $(this).removeClass("cursor-pointer");})

                .click(function (){window.location.href = "$toUserView" + $(this).data('usernameId');})
                });

            JS;
            $this->registerJs($curserPointer);
            $toUserView = Json::encode(Url::to(['inbox/create', 'receiverId' => '']));
            $signUpLogic =
                <<<JS
            $(document).ready(function (){
                $(".signupButton")
                .click(function (){
                    let receiverId = $(this).data('username-id');
                    window.location.href = "$toUserView" + receiverId;
                })
            });
            JS;
            $this->registerJs($signUpLogic);

            ?>


        </div>
