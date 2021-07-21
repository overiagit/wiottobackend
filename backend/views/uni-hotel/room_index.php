<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UniHotelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Uni Hotel Rooms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uni-hotel-room-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<!--        --><?//= Html::a('Create Uni Hotel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
//            'starId',
//            [
//                'attribute' => 'stars',
//                'value' => function ($model, $key, $index, $column) {
//                    return  $model->getStarName();
//                },
//                'format' =>'raw',
//            ],
            'hotel_uni_id',
            'hotel_id',
//            [
//                'attribute' => 'wiotto_name',
//                'value' => function ($model, $key, $index, $column) {
//                    return  $model->getHotelName();
//
//                },
//                'format' =>'raw',
//            ],
           ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
