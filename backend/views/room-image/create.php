<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RoomImage */

$this->title = 'Create Room Image';
$this->params['breadcrumbs'][] = ['label' => 'Room Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
