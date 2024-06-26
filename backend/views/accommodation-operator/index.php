<?php

use backend\models\AccommodationOperator;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\AccommodationOperatorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Astro hotels');
$this->params['breadcrumbs'][] = $this->title;
$notLinked82 = \backend\models\AccommodationOperator::getCountNotLinkedHotels('82');
?>
<div class="accommodation-operator-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Accommodation Operator')
            , ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="d-flex justify-content-end">
        <div  class="d-flex justify-content-between bg-light border border-danger border-2">
            <div><a  href=  "accommodation-operator?AccommodationOperatorSearch%5Bid%5D=&AccommodationOperatorSearch%5Bname%5D=&AccommodationOperatorSearch%5Bhotel_id%5D=0&AccommodationOperatorSearch%5BsupplierOperatorServiceTypeId%5D="
                     class="btn btn-outline-danger align-self-end">Hotels Not linked Seychels <?=$notLinked82?></a>
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
            'name',
            'hotel_id',
            'supplierOperatorServiceTypeId',
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
                        $url = Url::current(['/services', 'supplierOperatorServiceTypeId' => $model['supplierOperatorServiceTypeId']
                            ]);
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
//            [
//                'class' => ActionColumn::className(),
//                'urlCreator' => function ($action, AccommodationOperator $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                 }
//            ],
//            [
//                'attribute' => 'wiotto_hotel_name',
//                'value' => function ($model, $key, $index, $column) {
//                    return  $model->getHotelName();
//
//                },
//
//                'filter' => Html::activeInput('text',$searchModel,'wiotto_hotel_name',
//                    ['class' => 'form-control', 'prompt' => 'Все']),
//            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
