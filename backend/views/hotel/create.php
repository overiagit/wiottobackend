<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Hotel */
/* @var $data array */
/* @var $imageSearchModel backend\models\HotelImageSearch */
/* @var $imageDataProvider yii\data\ActiveDataProvider */

$this->title = 'Create Hotel';
$this->params['breadcrumbs'][] = ['label' => 'Hotels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data'=> $data,
        'imageSearchModel' => $imageSearchModel,
        'imageDataProvider' => $imageDataProvider,
    ]) ?>

</div>
