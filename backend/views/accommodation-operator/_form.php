<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AccommodationOperator $model */
/** @var yii\widgets\ActiveForm $form */
/** @var $data array */
?>

<div class="accommodation-operator-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<!--    --><?php //= $form->field($model, 'hotel_id')->textInput() ?>

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

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
