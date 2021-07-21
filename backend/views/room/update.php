<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Room */
/* @var $data array */

$this->title =  $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rooms', 'url' => [$model->hotel_id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="room-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' =>$data,
    ]) ?>

</div>
