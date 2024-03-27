<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UniRoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Uni Rooms';
$this->params['breadcrumbs'][] = $this->title;
$notLinked228 = \backend\models\UniRoom::getCountNotLinkedRooms('228');
$notLinked217 = \backend\models\UniRoom::getCountNotLinkedRooms('217');
?>
<div class="uni-room-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="d-flex justify-content-end">
        <div  class="d-flex justify-content-between bg-light border border-danger border-2">
            <div><a  href=  "uni-room?UniRoomSearch%5Bid%5D=&UniRoomSearch%5Btitle%5D=&UniRoomSearch%5Broom_type_id%5D=0&UniRoomSearch%5Bwiotto_name%5D=&UniRoomSearch%5BCountryId%5D=228&UniRoomSearch%5Bhotel_uni_id%5D=&UniRoomSearch%5Buni_hotel%5D=&UniRoomSearch%5Bdate_add%5D=&UniRoomSearch%5Bnot_like%5D=1&id=%5D"
                     class="btn btn-outline-danger align-self-end">Rooms Not linked Maldives</a>
            </div>
            <div><a  href=  "uni-room?UniRoomSearch%5Bid%5D=&UniRoomSearch%5Btitle%5D=&UniRoomSearch%5Broom_type_id%5D=0&UniRoomSearch%5Bwiotto_name%5D=&UniRoomSearch%5BCountryId%5D=228&UniRoomSearch%5Bhotel_uni_id%5D=&UniRoomSearch%5Buni_hotel%5D=&UniRoomSearch%5Bdate_add%5D=&UniRoomSearch%5Bnot_like%5D=0&id=%5D"
                     class="btn btn-outline-danger align-self-end">All <?=$notLinked228?></a>
            </div>
        </div>
        <div class="d-flex justify-content-between bg-white border border-success border-2">
            <div><a  href=  "uni-room?UniRoomSearch%5Bid%5D=&UniRoomSearch%5Btitle%5D=&UniRoomSearch%5Broom_type_id%5D=0&UniRoomSearch%5Bwiotto_name%5D=&UniRoomSearch%5BCountryId%5D=217&UniRoomSearch%5Bhotel_uni_id%5D=&UniRoomSearch%5Buni_hotel%5D=&UniRoomSearch%5Bdate_add%5D=&UniRoomSearch%5Bnot_like%5D=1&id=%5D"
                     class="btn btn-outline-danger align-self-end">Rooms Not linked Indonesia</a>
            </div>
            <div><a  href=  "uni-room?UniRoomSearch%5Bid%5D=&UniRoomSearch%5Btitle%5D=&UniRoomSearch%5Broom_type_id%5D=0&UniRoomSearch%5Bwiotto_name%5D=&UniRoomSearch%5BCountryId%5D=217&UniRoomSearch%5Bhotel_uni_id%5D=&UniRoomSearch%5Buni_hotel%5D=&UniRoomSearch%5Bdate_add%5D=&UniRoomSearch%5Bnot_like%5D=0&id=%5D"
                     class="btn btn-outline-danger align-self-end">All <?=$notLinked217?></a>
            </div>
        </div>
    </div>
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
                'filter' => Html::activeInput('text',$searchModel,'wiotto_name',
                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],
            [
                'attribute' => 'countryId',
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getUniHotel()->CountryId;
                },
                'filter' => Html::activeInput('text',$searchModel,'CountryId',
                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],
            'hotel_uni_id',
            [
                'attribute' => 'uni_hotel',
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getUniHotel()->title;
                },
                'filter' => Html::activeInput('text',$searchModel,'uni_hotel',
                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],

            'maxpax',
            'parent',
            'date_add',
            ['class' => 'yii\grid\ActionColumn'
                ,'template'=>'{update}',],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
