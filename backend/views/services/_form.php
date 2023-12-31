<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Services $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $data */
?>

<div class="services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'supplierOperatorServiceTypeId')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'readonly'=>true]) ?>

    <?= $form->field($model, 'minimumPax')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'maximumPax')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'isInactive')->textInput(['readonly'=>true]) ?>
    <div class="form-group row">
        <div class="col col-md-3">
            <?= $form->field($model, 'room_type_id')->textInput(['readonly'=>true , ])->label(false) ?>
        </div>

        <div class="col col-md-6">

            <?= $form->field($model, 'room_type_id')->dropDownList(
                $data['room'],
                ['prompt' => '', 'id' => 'select-room_type_id','onChange'=>'
                     $("#uniroom-room_type_id").val(this.value);
                    ']
            )->label(false) ?>
        </div>
        <div class="col col-md-3">
            <?=Html::button('Add room',['class'=>"btn btn-primary", 'data-toggle'=>"modal" ,'data-target'=>"#frmCreateRoom"]); ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
