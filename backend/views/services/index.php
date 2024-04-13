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
?>
<div class="services-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Services'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
