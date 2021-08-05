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
        'pager' => [
            'options'=>['class'=>'pagination , btn'],
            'maxButtonCount'=>25,    // Set maximum number of page buttons that can be displayed
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'villa',
            'rooms',
            'exbeds',
            //'note:ntext',
            'hotel_id',
            [
                'attribute' => 'hotel_name',
                'contentOptions' => [ 'style' => 'width: 7%;' ],
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getHotel()->name;
                },

                'filter' => Html::activeInput('text',$searchModel,'hotel_name',
                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],
            'active',
//            'uni_room_type_ids',

            [
                'attribute' => 'uni_room_type_ids',
                'contentOptions' => [ 'style' => 'width: 7%;' ],
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getUniRoomIds();
                },

                'filter' => Html::activeInput('text',$searchModel,'uni_room_type_ids',
                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],

            [
                'attribute' => 'image_ids',
                'contentOptions' => ['style' => 'width:150px','class' => 'text-wrap'],
                'value' => function ($model, $key, $index, $column) {
                   $ids =   $model->getImageIds();
                   if($ids)
                    return    substr( $ids, 0, 15).'...';
                   return $ids ;
                },

//                'filter' => Html::activeInput('text',$searchModel,'uni_room_type_ids',
//                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],

            [
                'attribute' => 'note_ru',
                'contentOptions' => ['style' => 'width:100px;'],
                'value' => function ($model, $key, $index, $column) {
                     $note = $model->getNoteLangRu();
                     if($note)
                          return strip_tags(Html::decode(substr( $note->note , 0, 15))).'...';
                     return  $note->note;

                },

            ],
            [
                'attribute' => 'note_fr',
                'value' => function ($model, $key, $index, $column) {
                    $note = $model->getNoteLangFr();
                    if($note)
                        return strip_tags(Html::decode(substr( $note->note , 0, 15))).'...';
                    return  $note->note;
                    },

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
