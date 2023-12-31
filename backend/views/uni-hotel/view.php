<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UniHotel */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Uni Hotels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="uni-hotel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'starId',
            'ResortId',
            'CountryId',
            'hotel_id',
            'Longitude',
            'Latitude',
            'date_add',
        ],
    ]) ?>

</div>
