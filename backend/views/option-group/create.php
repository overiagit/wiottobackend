<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\OptionGroup $model */

$this->title = Yii::t('app', 'Create Option Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Option Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="option-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
