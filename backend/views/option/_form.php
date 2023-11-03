<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Option $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $data */
?>

<div class="option-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

<!--    --><?php //= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'show')->textInput() ?>

    <?= $form->field($model, 'uni_id')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'tourplan_code')->textInput(['maxlength' => true,'readonly'=>true]) ?>


    <?= $form->field($model, 'country_id')->dropDownList(
        [0=>"All",582=>"Maldives", 217=>"Indonesia"],
        ['prompt' => 'For all', 'id' => 'select_country_id']
    )->label('Country') ?>

    <?= $form->field($model, 'group_id')->dropDownList(
        $data['option_group'],
        ['prompt' => 'For all', 'id' => 'select_group_id']
    )->label('Option group') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
