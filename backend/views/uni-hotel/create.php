<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UniHotel */

$this->title = 'Create Uni Hotel';
$this->params['breadcrumbs'][] = ['label' => 'Uni Hotels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uni-hotel-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
