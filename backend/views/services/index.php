<?php

use backend\models\Services;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\ServicesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Astro rooms');
$this->params['breadcrumbs'][] = $this->title;
$notLinked82 = \backend\models\Services::getCountNotLinkedRooms('82');
?>
<div class="services-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Services'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="d-flex justify-content-end">
        <div  class="d-flex justify-content-between bg-light border border-danger border-2">
            <div><a  href=  "services?ServicesSearch%5Bid%5D=&ServicesSearch%5Bname%5D=&ServicesSearch%5BminimumPax%5D=&ServicesSearch%5BmaximumPax%5D=&ServicesSearch%5Broom_type_id%5D=0&ServicesSearch%5Bhotel_id%5D=&ServicesSearch%5Baccommodation_operator_id%5D=&ServicesSearch%5Bhotel_name%5D="
                     class="btn btn-outline-danger align-self-end">Rooms Not linked Seychels  <?=$notLinked82?></a>
            </div>
            <!--            <div><a  href=  "uni-room?UniRoomSearch%5Bid%5D=&UniRoomSearch%5Btitle%5D=&UniRoomSearch%5Broom_type_id%5D=0&UniRoomSearch%5Bwiotto_name%5D=&UniRoomSearch%5BCountryId%5D=228&UniRoomSearch%5Bhotel_uni_id%5D=&UniRoomSearch%5Buni_hotel%5D=&UniRoomSearch%5Bdate_add%5D=&UniRoomSearch%5Bnot_like%5D=0&id=%5D"-->
            <!--                     class="btn btn-outline-danger align-self-end">All --><?php //=$notLinked82?><!--</a>-->
            <!--            </div>-->
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
//            'supplierOperatorServiceTypeId',
            'name',
//            'minimumPax',
            [
                'attribute' => 'minimumPax',
                'headerOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],
                'contentOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],
            ],
//            'maximumPax',
            [
                'attribute' => 'maximumPax',
                'headerOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],
                'contentOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],
            ],
            //'isInactive',
//            'room_type_id',
            [
                'attribute' => 'room_type_id',
                'headerOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],
                'contentOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],
            ],
//            'hotel_id',
            [
                'attribute' => 'hotel_id',
                'headerOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],
                'contentOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],
            ],
//            'accommodation_operator_id',
            [
                'attribute' => 'accommodation_operator_id',
                'headerOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],
                'contentOptions' => [ 'style' => 'width: 18%; max-width:120px;word-wrap:normal;white-space:pre-line;' ],
            ],
            [
                'attribute' => 'hotel_name',
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getAccommodationOperatorName($model['accommodation_operator_id']);
                },
                'filter' => Html::activeInput('text',$searchModel,'hotel_name',
                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],
            'date_add',
            'date_upd',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Services $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
