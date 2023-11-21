<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var backend\models\Option $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $data */
?>

<div class="option-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>



    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'show')->checkbox() ?>
    <?= $form->field($model, 'show_list')->checkbox() ?>

    <?= $form->field($model, 'uni_id')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'tourplan_code')->textInput(['maxlength' => true,'readonly'=>true]) ?>


<!--    --><?php //= $form->field($model, 'country_id')->dropDownList(
//        [582=>"Maldives", 217=>"Indonesia"],
//        ['prompt' => 'For all', 'id' => 'select_country_id']
//    )->label('Country') ?>

    <div class="form-group row">
        <div class="col-10">
            <?= $form->field($model, 'country_ids'
            )->widget(Select2::classname(), [
                'data' =>[582=>"Maldives", 217=>"Indonesia"], //\yii\helpers\ArrayHelper::map($data['feature_list'], 'id', 'value'),
                'options' => ['placeholder' => Yii::t('app', 'Country')
                    ,'allowClear' => true, 'id'=>'cbCountry', 'multiple' => true,
                    'class' => "form-control select2-show-search  border-bottom-0",
//                    'value' => is_array($model->country_id)?
// implode(',', $model->country_id): explode(',', $model->country_id),
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'width' => '100%',
                    'theme'=>'material',
                ],
            ])->label('Country') ?>
        </div>
    </div>

    <?= $form->field($model, 'group_id')->dropDownList(
        $data['option_group'],
        ['prompt' => 'For all', 'id' => 'select_group_id']
    )->label('Option group') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
