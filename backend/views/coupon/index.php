<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CouponSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Coupons');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Coupon'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'description',
            'note',
            'percent',
            [
                'attribute'=>'date_from',
                'format' => ['date', 'php:Y-m-d']
            ],
            [
                'attribute'=>'date_to',
                'format' => ['date', 'php:Y-m-d']
            ],
//            'price_from',
//            'price_to',
//            'apply_price_from',
//            'apply_price_to',
//            'order',
            [
                'attribute' => 'price_from',
                'headerOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line; ' ],
//                'noWrap' => false,
//                'mergeHeader'=>true,
            ],
            [
                'attribute' => 'price_to',
                'headerOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],
            ],
            [
                'attribute' => 'apply_price_from',
                'headerOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],
            ],
            [
                'attribute' => 'apply_price_to',
                'headerOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],
            ],
            'hotel_id',
            'active',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>