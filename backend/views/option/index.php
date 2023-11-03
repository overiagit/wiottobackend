<?php

use backend\models\Option;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\OptionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Options');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="option-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Option'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id',
                'contentOptions' => ['style' => 'width:30px'],
                ],

//            'id',
//            'type',
            'name',
            'show',
//            'uni_id',
            //'tourplan_code',
//            'country_id',
            [
                 'class' => 'kartik\grid\EnumColumn',
                 'attribute' => 'country_id',
                 'enum' => [
                     '582' => 'Maldives',
                     '217' => 'Indonesia',
                 ],
                 'filter' => [  // will override the grid column filter (i.e. `loadEnumAsFilter` will be parsed as `false`)
                     '582' => 'Maldives',
                     '217' => 'Indonesia',
                 ],
            ],

//            'group_name',
            [
                'label' => 'Group',
                'attribute' => 'group_id',
                'contentOptions' => [ 'style' => 'width: 7%;' ],
                'value' => function ($model, $key, $index, $column) {
                    $res =  $model->getGroup();
                    if(isset($res))
                        return $res->name;
                    else
                        return null;
                },
                'filter' => Html::activeInput('text',$searchModel,'group_name',
                    ['class' => 'form-control', 'prompt' => 'Все']),
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Option $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'type' => $model->type]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
