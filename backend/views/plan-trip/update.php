<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PlanTrip */
/* @var $data array */



$this->title =  $model->note;
$this->params['breadcrumbs'][] = ['label' => 'Best for you', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="best-for-you-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data'=> $data,

    ]) ?>

</div>
