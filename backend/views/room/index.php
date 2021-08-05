<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rooms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'villa',
            'rooms',
            'exbeds',
            //'note:ntext',
            'hotel_id',
            'active',
//            'uni_room_type_ids',

            [
                'attribute' => 'uni_room_type_ids',
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getUniRoomIds();
                },
//                'format' =>'raw',
//                'filter' => Html::activeDropDownList($searchModel
//                    , 'wiotto_hotel_name', Hotel::getHotelList(),
//                    ['class' => 'form-control', 'prompt' => 'Все']),
//                'filter' => true,
                'filter' => Html::activeInput('text',$searchModel,'uni_room_type_ids',
                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],

            ['class' => 'yii\grid\ActionColumn'
                ,'template'=>'{view}{update}{delete}{photo}'
                 ,'buttons' =>[
                 'photo'=>function($url, $model, $key){
                        $iconName = 'info-sign';
                        $title = \Yii::t('app', 'Photo');
                        $id = 'photo-'.$key;
                        $options = [
                            'title'=>$title,
                            'aria-label'=>$title,
                            'data-pjax'=>'0',
                            'id'=>$id,
                        ];
                        $url = Url::current(['/room-image', 'room_id' => $key]);
                        $icon = Html::tag('span', '&#127976;', ['class' => "glyphicon glyphicon-$iconName"]);
                        return Html::a($icon, $url, $options);
                    },
                    ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
