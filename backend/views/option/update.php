<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Option $model */
/** @var array $data */

$this->title = Yii::t('app', 'Update Option: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Options'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'type' => $model->type]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="option-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data'=>$data,
    ]) ?>

</div>
