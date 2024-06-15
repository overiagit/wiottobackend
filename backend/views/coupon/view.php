<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Coupon */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Coupons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="coupon-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-striped table-bordered detail-view fix-width'],
        'attributes' => [
            'id',
            'name',
            'description',
            [
                'label'=>'Description EN' ,
                'attribute'=>'description_en',
                'value' => function($model){
                    $lang = \backend\models\CouponLang::findOne(["id"=>$model->id, "lang"=>"en"]);
                    if($lang)
                        return $lang->description;
                    return null;
                }
            ],
            [
                'label'=>'Description RU' ,
                'attribute'=>'description_ru',
                'value' => function($model){
                   $lang = \backend\models\CouponLang::findOne(["id"=>$model->id, "lang"=>"ru"]);
                   if($lang)
                       return $lang->description;
                   return null;
                }
            ],
            [
                'label'=>'Description FR' ,
//                'header'=>'Description_fr',
                 'attribute'=>'description_fr',
                'value' => function($model){
                    $lang = \backend\models\CouponLang::findOne(["id"=>$model->id, "lang"=>"fr"]);
                    if($lang)
                        return $lang->description;
                    return null;
                }
            ],
            'note',
            'percent',
//            'date_from',
//            'date_to',
            [
                'attribute'=>'date_from',
                'format' => ['date', 'php:Y-m-d']
            ],
//            'date_to',
            [
                'attribute'=>'date_to',
                'format' => ['date', 'php:Y-m-d']
            ],
            'price_from',
            'price_to',
            'apply_price_from',
            'apply_price_to',
            'order',
            'hotel_id',
            'active',
        ],
    ]) ?>

</div>