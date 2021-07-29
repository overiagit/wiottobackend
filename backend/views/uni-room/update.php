<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UniRoom */
/* @var $data array */

$this->title = 'Update Uni Room: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Uni Rooms', 'url' => [$model->hotel_uni_id]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$this->registerJsFile('@web/js/room.js',
    ['depends' => [\yii\web\JqueryAsset::class]
    ,'position' => \yii\web\View::POS_END]
);
?>

<div id="my-success" class="alert-success alert alert-dismissible" style="display: none;" role="alert">
    Room created successfully.
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
</div>

<div id="my-warning" class="alert-warning alert alert-dismissible" style="display: none;" role="alert">
    Something wrong!
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
</div>

<div class="uni-room-update">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
