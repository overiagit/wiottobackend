<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UniRoom */

$this->title = 'Create Uni Room';
$this->params['breadcrumbs'][] = ['label' => 'Uni Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uni-room-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
