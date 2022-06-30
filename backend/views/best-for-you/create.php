<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Hotel */
/* @var $data array */
/* @var $imageSearchModel backend\models\HotelImageSearch */
/* @var $imageDataProvider yii\data\ActiveDataProvider */

$this->title = 'Create Best for you';
$this->params['breadcrumbs'][] = ['label' => 'Best for you', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="best-for-you-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data'=> $data,
    ]) ?>

</div>
