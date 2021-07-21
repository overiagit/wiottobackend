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
?>
<div class="uni-hotel-index">

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
//            'CountryId',
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
            //'date_add',

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
