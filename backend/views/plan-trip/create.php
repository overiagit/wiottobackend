<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PlanTrip */
/* @var $data array */
/* @var $imageSearchModel backend\models\HotelImageSearch */
/* @var $imageDataProvider yii\data\ActiveDataProvider */

$this->title = 'Create Plan your trip';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-trip">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data'=> $data,
    ]) ?>

</div>
