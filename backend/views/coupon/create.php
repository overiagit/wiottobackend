<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Coupon */
/* @var $data array */

$this->title = Yii::t('app', 'Create Coupon');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Coupons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,"data"=>$data
    ]) ?>

</div>