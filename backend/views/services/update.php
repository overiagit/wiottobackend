<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Services $model */
/** @var array $data */

$this->title = Yii::t('app', 'Update Services: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

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
<div class="services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
