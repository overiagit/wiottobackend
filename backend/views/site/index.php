<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>
        <p class="lead"></p>
        <p><a class="btn btn-lg btn-success" href="<?= Url::to('/uni-hotel')?>">Get started with Hotels</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                working with hotels!
            </div>
        </div>

    </div>
</div>
