<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UniHotel */
/* @var $data array */

$this->title =  $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Uni Hotels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="uni-hotel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
