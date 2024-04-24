<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HotelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $on_request mixed */
/* @var $tourplan yii\data\ActiveDataProvider */


$this->title = 'Hotels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Hotel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'country_id',
//            'type_id',
//            'town_id',
            'name',
//            'latitude',
            //'longitude',
            //'town_region_id',
            //'comment:ntext',
            //'note:ntext',
            'location_id',
            [
                'attribute' => 'active',
                'headerOptions' => [ 'style' => 'width: 10%; max-width:80px;word-wrap:normal;white-space:pre-line;' ],
                'contentOptions' => [ 'style' => 'width: 10%; max-width:80px;word-wrap:normal;white-space:pre-line;' ],
            ],
            //'country_id',
            //'island_id',
            //'condition:ntext',
            [
                'attribute' => 'images',
//                'contentOptions' => [ 'style' => 'width: 7%;' ],
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getImagesIds();
                },
                'headerOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],
                'contentOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],


//                'filter' => Html::activeInput('text',$searchModel,'images',
//                    ['class' => 'form-control', 'prompt' => 'All']),
            ],

//           'images',

            ['class' => 'yii\grid\ActionColumn'
                ,'template'=>'{update}{room}{photo}'
                ,'buttons' =>[
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
                        $url = Url::current(['/room', 'id' => $key]);
                        $icon = Html::tag('span', '&#127958;', ['class' => "glyphicon glyphicon-$iconName"]);
                        return Html::a($icon, $url, $options);
                    },
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
                        $url = Url::current(['/hotel-image', 'hotel_id' => $key]);
                        $icon = Html::tag('span', '&#127976;', ['class' => "glyphicon glyphicon-$iconName"]);
                        return Html::a($icon, $url, $options);
                    },

            ],
                ],
            ]

    ]); ?>

    <div>
        <div class="form-group row">
            <h3><?= Html::encode("Hotels on request") ?></h3>
            <?= Select2::widget( [ 'name'=>'request_hotels',
                'value'=>$on_request,
                'data' => \yii\helpers\ArrayHelper::map($tourplan, 'id', 'hotel'),
                'options' => ['placeholder' => Yii::t('app', 'Hotel on request')
                    ,'allowClear' => true, 'id'=>'cbHotelOnreq', 'multiple' => true,
                    'class' => "form-control select2-show-search  border-bottom-0",
                    'onchange' => 'saveSelection(this);', // Викличте JavaScript функцію, яка зберігає дані
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'width' => '100%',
                    'theme'=>'bootstrap',
                ],
            ])?>
        </div>
    </div>
</div>
