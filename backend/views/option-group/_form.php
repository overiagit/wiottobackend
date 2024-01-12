<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var backend\models\OptionGroup $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="option-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'country_id')->dropDownList(
//        [582=>"Maldives", 217=>"Indonesia", 82=>"Seychelles"],
//        ['prompt' => 'For all', 'id' => 'select_country_id']
//    )->label('Country') ?>

    <div class="form-group row">
        <div class="col-10">
            <?= $form->field($model, 'country_ids'
            )->widget(Select2::classname(), [
                'data' =>[582=>"Maldives", 217=>"Indonesia", 82=>"Seychelles"], //\yii\helpers\ArrayHelper::map($data['feature_list'], 'id', 'value'),
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

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
