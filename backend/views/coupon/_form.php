<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Coupon */
/* @var $data array */
///* @var $descEn backend\models\CouponLang */
///* @var $descFr backend\models\CouponLang */
///* @var $descRu backend\models\CouponLang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coupon-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group row">
        <div class="col col-md-10 ">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col col-md-10 ">
            <?= $form->field($model, 'description')->textarea(['maxlength' => true])->label("Description EN") ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col col-md-10 ">
            <label for="txt_description_fru">Description RU</label>
            <?= Html::textarea('description_ru', $data['description']['ru']['description'],['id'=>'txt_description_ru','class'=>'form-control', 'rows'=>2]) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col col-md-10 ">
            <label for="txt_description_fr">Description FR</label>
            <?= Html::textarea('description_fr', $data['description']['fr']['description'],['id'=>'txt_description_fr','class'=>'form-control', 'rows'=>2]) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col col-md-10 ">
            <?= $form->field($model, 'note')->textarea(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-4 col-md-3 ">
    <?= $form->field($model, 'percent')->textInput(['type'=>'number', 'step'=>1]) ?>
        </div>
<!--    </div>-->
<!--    <div class="form-group row">-->
        <div class="col-4 col-md-3 ">
    <?= $form->field($model, 'date_from')->widget(
        DatePicker::className(),
        [
            'type' => DatePicker::TYPE_INPUT,
            'options' => ['placeholder' => 'Select date ...','format' => 'yyyy-mm-dd',],
//            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
//                'startDate' => DateTime::,
//                'todayHighlight' => true
            ]
        ]
    ); ?>
        </div>
<!--    </div>-->
<!--    <div class="form-group row">-->
        <div class="col-4 col-md-3 ">
    <?= $form->field($model, 'date_to')->widget(
        DatePicker::className(),
        [
            'type' => DatePicker::TYPE_INPUT,
           'options' => ['placeholder' => 'Select date ...','format' => 'yyyy-mm-dd',],
//            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
//                'startDate' => '01-Mar-2014 12:00 AM',
//                'todayHighlight' => true
            ]
        ]
    );
 ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-4 col-md-3 ">
            <?= $form->field($model, 'price_from')->textInput(['type'=>'number', 'step'=>1]) ?>
        </div>
        <div class="col-4 col-md-3 ">
            <?= $form->field($model, 'price_to')->textInput(['type'=>'number', 'step'=>1]) ?>
        </div>

    </div>
    <div class="form-group row">
        <div class="col-4 col-md-3 ">
            <?= $form->field($model, 'apply_price_from')->textInput(['type'=>'number', 'step'=>1]) ?>
        </div>
        <div class="col-4 col-md-3 ">
            <?= $form->field($model, 'apply_price_to')->textInput(['type'=>'number', 'step'=>1]) ?>
        </div>

    </div>
    <div class="form-group row">
        <div class="col col-md-1 ">
    <?= $form->field($model, 'active')->checkbox() ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-6 col-md-6 ">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success w-100']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
