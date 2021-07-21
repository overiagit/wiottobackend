<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UniRoom */
/* @var $form yii\widgets\ActiveForm */
/* @var $data array */


?>


<div class="row">
    <div class="col-12 col-md-8">
<div class="uni-room-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id')->textInput(['readonly'=>true]) ?>
<!--    <div class="row">-->
<!--        <div class="col-6 col-md-4"><span>ID-</span><span>--><?//= $model['id'] ?><!--</span></div>-->
<!--        <div class="col-6 col-md-8"><span>--><?//= $model['title'] ?><!--</span></div>-->
<!--    </div>-->

    <?= Html::hiddenInput("name", $model['title'], ['id'=>'hidden_name'])?>
    <?= Html::hiddenInput("hotel_id", $model['hotel_id'], ['id'=>'hidden_hotel_id'])?>

    <div class="form-group row">
        <div class="col col-md-3">
            <?= $form->field($model, 'room_type_id')->textInput(['readonly'=>true , ])->label(false) ?>
        </div>
            <!--        <div class="col-6 col-md-4"><span>ROOM_ID-</span><span>--><?//= $model['room_type_id'] ?><!--</span></div>-->
<!--        <div class="col-6 col-md-8">-->
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
<!--        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">-->
<!--            Add room-->
<!--        </button>-->
            </div>
<!--        </div>-->
<!--    </div>-->


<!---->
<!--    --><?//= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'room_type_id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'hotel_uni_id')->textInput() ?>
<!---->
    <?= $form->field($model, 'hotel_id')->textInput(['readonly'=>true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true,'readonly'=>true]) ?>

<!--    --><?//= $form->field($model, 'date_add')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="frmCreateRoom" tabindex="-1" role="dialog" aria-labelledby="frmCreateRoomCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="frmCreateRoomLongTitle"><?= $model->title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<!--                <div class="form-group row">-->
<!--                    <div class="col col-md-10">-->
<!--                --><?//= Html::input('text','r_new_name',$model->title,['readonly'=>true,'id'=>'new_room','class'=>'form-control'])?>
<!--                    </div></div>-->
                <div class="form-group row">
                    <div class="col col-md-5 h-auto">
                        <label  class="control-label"  for="chlVilla">Villa</label>
<!--                --><?//= Html::dropDownList('villa', null, $data['villa'] ,['class'=>'form-control'])?>
                        <?= Html::checkboxList('villa', '0', $data['villa'] ,['class'=>'form-control h-auto', 'id'=>'chlVilla'])?>

                </div>
                    <div class="col col-md-7 h-auto">
                    <div class="form-group row">
                        <div class="col col-md-8">
                            <label class="control-label" for="new_room_cnt">Rooms</label>
                            <?= Html::input('number','r_rooms',1,['readonly'=>false,'id'=>'new_room_cnt','class'=>'form-control' , 'min'=> 0 ])?>
                        </div>

                        <div class="col col-md-8">
                            <label class="control-label"  for="new_room_exb">Extrabed</label>
                            <?= Html::input('number','r_exb',1,['readonly'=>false,'id'=>'new_room_exb','class'=>'form-control',  'min'=> 0])?>
                        </div></div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnAddRoom">Save changes</button>
            </div>
        </div>
    </div>
</div>
