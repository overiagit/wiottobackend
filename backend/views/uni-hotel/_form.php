<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UniHotel */
/* @var $form yii\widgets\ActiveForm */
/* @var $data array */
?>

<div class="uni-hotel-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group row">
        <div class="col-6 col-md-2">
            <?= $form->field($model, 'id' )->textInput(['readonly'=>true]) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true,'readonly'=>true ,]) ?>
        </div>
    </div>


    <div class="form-group row">
        <div class="col-6 col-md-2">
            <?= $form->field($model, 'starId' )->textInput(['readonly'=>true]) ?>
        </div>
        <div class="col-6 col-md-8">

            <label for="txtStarName" class="control-label">Star</label>
           <?= Html::textInput('',$model->getStarName(), ['id'=>'txtStarName','readonly'=>true, 'class'=>'form-control']) ?>
        </div>
    </div>


    <div class="form-group row">
        <div class="col-6 col-md-2">
            <?= $form->field($model, 'ResortId')->textInput(['readonly'=>true]) ?>
        </div>
        <div class="col-6 col-md-8">
            <label for="txtResortName" class="control-label">Resort</label>
            <?= Html::textInput('',$model->getResortName(), ['id'=>'txtResortName','readonly'=>true, 'class'=>'form-control']) ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-6 col-md-2">
            <?= $form->field($model, 'CountryId')->textInput(['readonly'=>true]) ?>
        </div>
        <div class="col-6 col-md-8">
            <label for="txtCountryName" class="control-label">Country</label>
            <?= Html::textInput('',$model->getCountryName(), ['id'=>'txtCountryName','readonly'=>true, 'class'=>'form-control']) ?>
        </div>
    </div>


    <div class="form-group row">
        <div class="col-6 col-md-2">
            <?= $form->field($model, 'hotel_id')->textInput(['readonly'=>true,'id'=>'txtHotelId']) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'hotel_id')->dropDownList(
                $data['hotel'],
                ['prompt' => '', 'id' => 'select-hotel_id','onChange'=>'
                     $("#txtHotelId").val(this.value);
                    ']
            )->label('Wiotto hotel') ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-6 col-md-3">
    <?= $form->field($model, 'Longitude')->textInput(['type'=>'number']) ?>
        </div>
            <div class="col-6 col-md-3">
    <?= $form->field($model, 'Latitude')->textInput(['type'=>'number']) ?>
            </div>
        <div class="col-6 col-md-3">
    <?= $form->field($model, 'date_add')->textInput(['readonly'=>true]) ?>

        </div>
    </div>
    <div class="form-group row">
        <div class="col-12 col-md-6">
            <?= $form->field($model, 'location_id')->textInput(['type'=>'number','maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
