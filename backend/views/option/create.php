<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Option $model */
/** @var array $data */

$this->title = Yii::t('app', 'Create Option');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Options'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="option-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data'=>$data,
    ]) ?>

</div>
