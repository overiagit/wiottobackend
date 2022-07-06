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
            [
                'attribute' => 'note_en',
                'contentOptions' => [ 'style' => 'width: 20%;' ],
                'value' => 'note',
                'filter' => Html::activeInput('text',$searchModel,'note',
                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],
            [
                'attribute' => 'note_ru',
                'contentOptions' => [ 'style' => 'width: 20%;' ],
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getNoteRu();
                },
            ],
            [
                'attribute' => 'note_fr',
                'contentOptions' => [ 'style' => 'width: 20%;' ],
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getNoteFr();
                },
            ],
            [
                'label'=>'Link' ,
                'header'=>Yii::t('app', 'Link'),
                'contentOptions' => [ 'style' => 'width: 15%;' ],
                'attribute'=>'link',
                'value' => function ($model) {
                    return Html::a(Html::encode( $model->link),
                        $model->link, ['target'=>'blank']);
                },
                'format' => 'raw',
                'options'=>['class'=>'success','style'=>'font-weight:bold;'],
            ],
              'col',
               'active',

            ['class' => 'yii\grid\ActionColumn'
                ,'template'=>'{update}{delete}'
            ],
        ]

    ]); ?>


</div>