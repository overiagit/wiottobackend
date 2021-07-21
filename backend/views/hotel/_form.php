<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Hotel */
/* @var $data array */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotel-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group row">
        <div class="col-6 col-md-2">
            <?= $form->field($model, 'id')->textInput(['readonly'=>true]) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-6 col-md-2">
    <?= $form->field($model, 'type_id')->textInput(['readonly'=>true,'id'=>'txtHotelTypeId']) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'type_id')->dropDownList(
                $data['hotel_type'],
                ['prompt' => '', 'id' => 'select-hotel_type_id','onChange'=>'
                     $("#txtHotelTypeId").val(this.value);
                    ']
            )->label('Hotel type') ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-6 col-md-2">
    <?= $form->field($model, 'town_id')->textInput(['readonly'=>true,'id'=>'txtTownId']) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'town_id')->dropDownList(
                $data['town'],
                ['prompt' => '', 'id' => 'select-town_id','onChange'=>'
                     $("#txtTownId").val(this.value);
                    ']
            )->label('Town') ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-6 col-md-2">
            <?= $form->field($model, 'town_region_id')->textInput(['readonly'=>true,'id'=>'txtTownRegionId']) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'town_region_id')->dropDownList(
                $data['town_region'],
                ['prompt' => '', 'id' => 'select-town_region_id','onChange'=>'
                     $("#txtTownRegionId").val(this.value);
                    ']
            )->label('Town region') ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-6 col-md-2">
            <?= $form->field($model, 'island_id')->textInput(['readonly'=>true,'id'=>'txtIslandId']) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'island_id')->dropDownList(
                $data['island'],
                ['prompt' => '', 'id' => 'select-island_id','onChange'=>'
                     $("#txtIslandId").val(this.value);
                    ']
            )->label('Island') ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-6 col-md-3">
    <?= $form->field($model, 'location_id')->textInput(['type'=>'number','maxlength' => true]) ?>

        </div>
        <div class="col-6 col-md-3">
    <?= $form->field($model, 'latitude')->textInput(['type'=>'number','max' => '360', 'min'=>'0' , 'step' => '0.000001']) ?>
<!--                            --><?//= $form->field($model, 'latitude')->widget(\yii\widgets\MaskedInput::class, [
//                                'mask' => '9{1,3}(?:\.9{0,6})?',
//                            ]) ?>
        </div>
        <div class="col-6 col-md-3">
    <?= $form->field($model, 'longitude')->textInput(['type'=>'number','max' => "360", 'min'=>'0' , 'step' => '0.000001']) ?>
<!--    --><?//= $form->field($model, 'longitude')->widget(\yii\widgets\MaskedInput::class, [
//        'mask' => '9{1,3}\.{0,1}9{0,6}',
//    ]) ?>
        </div>
    </div>
<!--    --><?//= $form->field($model, 'town_region_id')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>



    <?= $form->field($model, 'country_id')->hiddenInput()->label(false); ?>



    <?= $form->field($model, 'condition')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
