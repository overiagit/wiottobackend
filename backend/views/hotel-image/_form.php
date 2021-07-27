<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\HotelImage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotel-image-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hotel_id')->hiddenInput() ?>


    <div class="form-group row">
        <div class="col-6 col-md-2">
            <?= $form->field($model, 'id')->textInput(['readonly'=>true]) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col col-md-10">
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

            <div class="form-group row">
                <div class="col col-md-10">
    <?= $form->field($model, 'path')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

    <div class="form-group row">
        <div class="col col-md-3">
            <?= $form->field($model, 'isMain')->checkbox() ?>
        </div>
            <div class="col col-md-3">
    <?= $form->field($model, 'orderNr')->textInput(['type'=>'number' , 'min'=>'0']) ?>
            </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
