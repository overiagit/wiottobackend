<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Hotel */
/* @var $data array */
/* @var $imageSearchModel backend\models\HotelImageSearch */
/* @var $imageDataProvider yii\data\ActiveDataProvider */

$this->title =  $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hotels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hotel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data'=> $data,
        'imageSearchModel' => $imageSearchModel,
        'imageDataProvider' => $imageDataProvider,
    ]) ?>

</div>
