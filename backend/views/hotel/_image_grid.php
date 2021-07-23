<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $imageSearchModel backend\models\HotelImageSearch */
/* @var $imageDataProvider yii\data\ActiveDataProvider */
?>
<div class="hotel-image">
    <p>
        <?= Html::a('Create Hotel Image', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $imageDataProvider,
        'filterModel' => $imageSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'hotel_id',
            'title',
            'description',
            'path',
            //'isMain',
            //'orderNr',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>


</div>