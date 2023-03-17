<?php

use backend\models\Hotel;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UniHotelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Uni Hotels';
$this->params['breadcrumbs'][] = $this->title;
$notLinked = \backend\models\UniRoom::getCountNotLinkedRooms();
?>
<div class="uni-hotel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="d-flex justify-content-end"><div><a  href=  "uni-room/526636?UniRoomSearch%5Bid%5D=&UniRoomSearch%5Btitle%5D=&UniRoomSearch%5Broom_type_id%5D=0&UniRoomSearch%5Bwiotto_name%5D=&UniRoomSearch%5BCountryId%5D=228&UniRoomSearch%5Bhotel_uni_id%5D=&UniRoomSearch%5Buni_hotel%5D=&UniHotelSearch%5Bid%5D=&UniHotelSearch%5Btitle%5D=&UniHotelSearch%5Bhotel_id%5D=0&UniHotelSearch%5Bwiotto_hotel_name%5D=&page=12"
           class="btn btn-outline-danger align-self-end"><?=$notLinked?> Not linked</a></div></div>
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
            [
                'attribute' => 'stars',
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getStarName();
                },
                'format' =>'raw',
//                'filter' => Html::activeDropDownList($searchModel
//                    , 'id', ServiceArea::getServiceAreaList(),
//                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],
//            'ResortId',
            'CountryId',
            [
                'attribute' => 'Country',
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getCountryName();
                },
                'format' =>'raw',

           ],
            'hotel_id',
//            'wiotto_hotel_name',
//            [
//                  'attribute' => 'wiotto_name',
//                   'value' =>   function ($data) {
//                       return $data->wiotto_hotel_name; // $data['name'] для массивов, например, при использовании SqlDataProvider.
//                   },
//            ],

            [
                'attribute' => 'wiotto_name',
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getHotelName();

                },
//                'format' =>'raw',
//                'filter' => Html::activeDropDownList($searchModel
//                    , 'wiotto_hotel_name', Hotel::getHotelList(),
//                    ['class' => 'form-control', 'prompt' => 'Все']),
//                'filter' => true,
                'filter' => Html::activeInput('text',$searchModel,'wiotto_hotel_name',
                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],

            //'Longitude',
            //'Latitude',
            'date_add',

//           ['class' => 'yii\grid\ActionColumn'],

            ['class' => 'yii\grid\ActionColumn'
                ,'template'=>'{update}{room}',
                'buttons' =>[
                    'room'=>function($url, $model, $key){
                        $iconName = 'info-sign';
                        $title = \Yii::t('app', 'Rooms');
                        $id = 'rooms-'.$key;
                        $options = [
                            'title'=>$title,
                            'aria-label'=>$title,
                            'data-pjax'=>'0',
                            'id'=>$id,
                        ];
                        $url = Url::current(['/uni-room', 'id' => $key]);
                        $icon = Html::tag('span', '&#9760;', ['class' => "glyphicon glyphicon-$iconName"]);
                        return Html::a($icon, $url, $options);
                    },
//                    'note'=>function($url, $model, $key){
//                        $iconName = 'info-sign';
//                        $title = \Yii::t('app', 'Note');
//                        $id = 'note-'.$key;
//                        $options = [
//                            'title'=>$title,
//                            'aria-label'=>$title,
//                            'data-pjax'=>'0',
//                            'id'=>$id,
//                        ];
//                        $url = Url::current(['note', 'id' => $key]);
//                        $icon = Html::tag('span', '&#9763;', ['class' => "glyphicon glyphicon-$iconName"]);
//                        return Html::a($icon, $url, $options);
//                    }
                ],

            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
