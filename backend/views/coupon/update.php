<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Coupon */
/* @var $data array */

$this->title = Yii::t('app', 'Update Coupon: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Coupons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="coupon-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,"data"=>$data
    ]) ?>

</div>