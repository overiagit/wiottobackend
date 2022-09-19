<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Coupon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coupon-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'percent')->textInput(['type'=>'number', 'step'=>1]) ?>

    <?= $form->field($model, 'date_from')->widget(
        DatePicker::className(),
        [
            'type' => DatePicker::TYPE_INPUT,
            'options' => ['placeholder' => 'Select date ...'],
//            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
//                'startDate' => DateTime::,
//                'todayHighlight' => true
            ]
        ]
    ); ?>

    <?= $form->field($model, 'date_to')->widget(
        DatePicker::className(),
        [
            'type' => DatePicker::TYPE_INPUT,
           'options' => ['placeholder' => 'Select date ...'],
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

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
