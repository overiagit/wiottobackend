<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Room */
/* @var $data array */

$this->title = 'Create Room';
$this->params['breadcrumbs'][] = ['label' => 'Rooms', 'url' => [$model->hotel_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,

    ]) ?>

</div>
