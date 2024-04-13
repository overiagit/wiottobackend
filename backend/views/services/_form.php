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

    <?= Html::hiddenInput("name", $model['name'], ['id'=>'hidden_name'])?>
    <?= Html::hiddenInput("hotel_id", $model['hotel_id'], ['id'=>'hidden_hotel_id'])?>

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

<!-- Modal -->
<div class="modal fade" id="frmCreateRoom" tabindex="-1" role="dialog" aria-labelledby="frmCreateRoomCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="frmCreateRoomLongTitle"><?= $model->name ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group row">
                    <div class="col col-md-5 h-auto">
                        <label  class="control-label"  for="chlVilla">Villa</label>
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

