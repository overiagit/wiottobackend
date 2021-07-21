<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UniHotel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="uni-hotel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'starId')->textInput() ?>

    <?= $form->field($model, 'ResortId')->textInput() ?>

    <?= $form->field($model, 'CountryId')->textInput() ?>

    <?= $form->field($model, 'hotel_id')->textInput() ?>

    <?= $form->field($model, 'Longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_add')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
