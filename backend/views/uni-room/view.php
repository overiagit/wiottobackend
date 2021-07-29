<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UniRoom */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Uni Rooms', 'url' => [$model->hotel_uni_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="uni-room-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'room_type_id',
            'hotel_uni_id',
            'hotel_id',
            'description',
            'date_add',
        ],
    ]) ?>

</div>
