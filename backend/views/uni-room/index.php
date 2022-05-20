<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UniRoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Uni Rooms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uni-room-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'room_type_id',
            [
                'attribute' => 'wiotto_room',
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getRoomName();
                },
//                'format' =>'raw',
//                'filter' => Html::activeDropDownList($searchModel
//                    , 'wiotto_hotel_name', Hotel::getHotelList(),
//                    ['class' => 'form-control', 'prompt' => 'Все']),
//                'filter' => true,
                'filter' => Html::activeInput('text',$searchModel,'wiotto_name',
                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],

            'hotel_uni_id',
            [
                'attribute' => 'uni_hotel',
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getUniHotel()->title;
                },
//                'format' =>'raw',
//                'filter' => Html::activeDropDownList($searchModel
//                    , 'wiotto_hotel_name', Hotel::getHotelList(),
//                    ['class' => 'form-control', 'prompt' => 'Все']),
//                'filter' => true,
                'filter' => Html::activeInput('text',$searchModel,'uni_hotel',
                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],
            //'description',
            //'date_add',
            'maxpax',
            'parent',

            ['class' => 'yii\grid\ActionColumn'
                ,'template'=>'{update}',],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
