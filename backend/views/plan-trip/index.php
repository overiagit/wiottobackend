<?php

/* @var $this yii\web\View */
/* @var $model string */

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PlanTripQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Plan your trip';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="best-for-you-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'country_id',
            'note',
             'link',

            ['class' => 'yii\grid\ActionColumn'
                ,'template'=>'{update}'
            ],
        ]

    ]); ?>


</div>