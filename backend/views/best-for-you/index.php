<?php

/* @var $this yii\web\View */
/* @var $model string */

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BestForYouSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use http\Url;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Best-for-you';
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
                'contentOptions' => [ 'style' => 'width: 15%;' ],
                'value' => 'note',
                'filter' => Html::activeInput('text',$searchModel,'note',
                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],
            [
                'attribute' => 'note_ru',
                'contentOptions' => [ 'style' => 'width: 15%;' ],
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getNoteRu();
                },
            ],
            [
                'attribute' => 'note_fr',
                'contentOptions' => [ 'style' => 'width: 14%;' ],
                'value' => function ($model, $key, $index, $column) {
                    return  $model->getNoteFr();
                },
            ],
//            'link',
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
            'row',
            'active',
            [
                'attribute' => 'photo',
                'format' => 'html',
                'contentOptions' => [ 'style' => 'width: 20%;' ],
                'value' => function ($data) {
                    return Html::img(Yii::getAlias('@web').'/upload/best_for_you/'. $data['photo']."?".time(),
                        ['width' => '200px']);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'
                ,'template'=>'{update}'

            ],
        ]

    ]); ?>


</div>