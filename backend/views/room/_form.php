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

        </div>

    <div class="col col-md-6 h-auto">
        <div class="form-group row">
            <div class="col col-md-4">

                    <?= $form->field($model, 'rooms')->input('number',['readonly'=>false,'id'=>'room_cnt','class'=>'form-control' , 'min'=> 0 ]) ?>

           </div>

            <div class="col col-md-4">

                    <?= $form->field($model, 'exbeds')->input('number',['readonly'=>false,'id'=>'r_exb','class'=>'form-control',  'min'=> 0]) ?>
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


    <?php if(Yii::$app->controller->action->id !== 'create'): ?>
    <div class="form-group row">
        <div class="col col-md-10">
            <?= Html::textarea('note_en', $data['note']['en']['note'],['id'=>'txt_note_en','class'=>'form-control', 'rows'=>6]) ?>
        </div>
        <div class="col col-md-2 align-content-center">
            <?=Html::button('EN',['id'=>'btn_note_en','class'=>"btn btn-primary btnNoteCond", 'data-toggle'=>"modal" ,'data-target'=>"#frmEditor"]); ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col col-md-10 ">
            <?= Html::textarea('note_ru', $data['note']['ru']['note'],['id'=>'txt_note_ru','class'=>'form-control', 'rows'=>6]) ?>
        </div>
        <div class="col col-md-2 align-content-center">
            <?=Html::button('RU',['id'=>'btn_note_ru','class'=>"btn btn-primary  btnNoteCond", 'data-toggle'=>"modal" ,'data-target'=>"#frmEditor"]); ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col col-md-10">
            <?= Html::textarea('note_fr', $data['note']['fr']['note'],['id'=>'txt_note_fr','class'=>'form-control', 'rows'=>6]) ?>
        </div>
        <div class="col col-md-2 align-content-center">
            <?=Html::button('FR',['id'=>'btn_note_fr','class'=>"btn btn-primary btnNoteCond", 'data-toggle'=>"modal" ,'data-target'=>"#frmEditor"]); ?>
        </div>
    </div>
    <?php  endif; ?>


    <?= $form->field($model, 'active')->checkbox() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
