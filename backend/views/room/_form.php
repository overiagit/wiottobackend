<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Room */
/* @var $form yii\widgets\ActiveForm */
/* @var $data array */
?>

<div class="room-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group row">
        <div class="col-6 col-md-2">
            <?= $form->field($model, 'id' )->textInput(['readonly'=>true]) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true,]) ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col col-md-5 h-auto">

<!--            --><?//= $form->field($model, 'villa')->textInput(['maxlength' => true]) ?>

            <label  class="control-label"  for="chlVilla">Villa</label>

            <?= Html::activeCheckboxList( $model,'villa',  $data['villa']
                ,['class'=>'form-control h-auto', 'id'=>'chlVilla'
                    , 'item' => function ($index, $label, $name, $checked, $value) use($model) {
                       ;

                        $checked = false;
                        if(is_array($model->villa))
                            $checked = $model->villa? in_array($value, $model->villa) : false;
                            else
                                $checked = explode(',',$model->villa)? in_array($value, explode(',',$model->villa)) : false;
                        return Html::checkbox($name, $checked, ['value' => $value, 'label' => Html::encode($label)]);
                    }])?>

<!--            --><?//= Html::checkboxList('villa', explode(',',$model->villa), $data['villa']
//                ,['class'=>'form-control h-auto', 'id'=>'chlVilla'])?>
<!---->
<!--                        --><?//= $form->field($model, 'villa')->checkboxList( $data['villa']
//                            ,['class'=>'form-control h-auto', 'id'=>'chlVilla'])?>

        </div>

    <div class="col col-md-6 h-auto">
        <div class="form-group row">
            <div class="col col-md-4">

                    <?= $form->field($model, 'rooms')->input('number',['readonly'=>false,'id'=>'room_cnt','class'=>'form-control' , 'min'=> 0 ]) ?>

<!--                <label class="control-label" for="new_room_cnt">Rooms</label>-->
<!--                --><?//= Html::input('number','rooms',1,['readonly'=>false,'id'=>'new_room_cnt','class'=>'form-control' , 'min'=> 0 ])?>
            </div>

            <div class="col col-md-4">

                    <?= $form->field($model, 'exbeds')->input('number',['readonly'=>false,'id'=>'r_exb','class'=>'form-control',  'min'=> 0]) ?>
<!--                <label class="control-label"  for="new_room_exb">Extrabed</label>-->
<!--                --><?//= Html::input('number','exb',1,['readonly'=>false,'id'=>'new_room_exb','class'=>'form-control',  'min'=> 0])?>
            </div>
        </div>
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
        <div class="col col-md-10">
    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
        </div>
    </div>

<!--    --><?//= $form->field($model, 'hotel_id')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

<!--    --><?//= $form->field($model, 'uni_room_type_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
