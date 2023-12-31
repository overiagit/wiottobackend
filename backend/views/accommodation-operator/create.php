<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\AccommodationOperator $model */
/** @var array $data  */

$this->title = Yii::t('app', 'Create Accommodation Operator');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accommodation Operators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accommodation-operator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
