  <?php

  use kartik\select2\Select2;
  use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Hotel */
/* @var $data array */
  /* @var $features array*/
/* @var $form yii\widgets\ActiveForm */
 /* @var $imageSearchModel backend\models\HotelImageSearch */
 /* @var $imageDataProvider yii\data\ActiveDataProvider */

//$this->registerJsFile('@web/summernote/summernote-bs4.min.js',['depends' => [\yii\web\JqueryAsset::class]]);
//$this->registerCssFile('@web/summernote/summernote-bs4.min.css');
//  $this->registerJsFile('@web/summernote/editor.js',
//      ['depends' => [\yii\web\JqueryAsset::class]
//          ,'position' => \yii\web\View::POS_END]
//  );

  \backend\assets\AppAssetSummerNote::register($this);
?>

<!--  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">-->
<!--  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>-->

<div class="hotel-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group row">
        <div class="col-6 col-md-2">
            <?= $form->field($model, 'id')->textInput(['readonly'=>true]) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-6 col-md-2">
    <?= $form->field($model, 'type_id')->textInput(['readonly'=>true,'id'=>'txtHotelTypeId']) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'type_id')->dropDownList(
                $data['hotel_type'],
                ['prompt' => '', 'id' => 'select-hotel_type_id','onChange'=>'
                     $("#txtHotelTypeId").val(this.value);
                    ']
            )->label('Hotel type') ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-6 col-md-2">
    <?= $form->field($model, 'town_id')->textInput(['readonly'=>true,'id'=>'txtTownId']) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'town_id')->dropDownList(
                $data['town'],
                ['prompt' => '', 'id' => 'select-town_id','onChange'=>'
                     $("#txtTownId").val(this.value);
                    ']
            )->label('Town') ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-6 col-md-2">
            <?= $form->field($model, 'town_region_id')->textInput(['readonly'=>true,'id'=>'txtTownRegionId']) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'town_region_id')->dropDownList(
                $data['town_region'],
                ['prompt' => '', 'id' => 'select-town_region_id','onChange'=>'
                     $("#txtTownRegionId").val(this.value);
                    ']
            )->label('Town region') ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-6 col-md-2">
            <?= $form->field($model, 'island_id')->textInput(['readonly'=>true,'id'=>'txtIslandId']) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'island_id')->dropDownList(
                $data['island'],
                ['prompt' => '', 'id' => 'select-island_id','onChange'=>'
                     $("#txtIslandId").val(this.value);
                    ']
            )->label('Island') ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-6 col-md-3">
    <?= $form->field($model, 'location_id')->textInput(['type'=>'number','maxlength' => true]) ?>

        </div>
        <div class="col-6 col-md-3">
    <?= $form->field($model, 'latitude')->textInput(['type'=>'number','max' => '360', 'min'=>'-360' , 'step' => '0.0000000000001']) ?>

        </div>
        <div class="col-6 col-md-3">
    <?= $form->field($model, 'longitude')->textInput(['type'=>'number','max' => "360", 'min'=>'-360' , 'step' => '0.0000000000001']) ?>

        </div>
    </div>

    <div class="form-group row">
        <?= $form->field($model, 'features'
        )->widget(Select2::classname(), [
            'data' =>$data['feature_list'], //\yii\helpers\ArrayHelper::map($data['feature_list'], 'id', 'value'),
            'options' => ['placeholder' => Yii::t('app', 'Feature')  ,'allowClear' => true, 'id'=>'cbFeature', 'multiple' => true,
                'class' => "form-control select2-show-search  border-bottom-0",
            ],
            'pluginOptions' => [
                           'allowClear' => true,
                'width' => '100%',

                           'theme'=>'material',
            ],
        ])->label(false) ?>
    </div>

    <div class="form-group row">
        <div class="col col-md-10">
        <?= $form->field($model, 'note')->textarea(['id'=>'txt_note_en','rows' => 6]) ?>
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
    <?= $form->field($model, 'country_id')->hiddenInput()->label(false); ?>
    <div class="form-group row">
        <div class="col col-md-10">
            <?= $form->field($model, 'condition')->textarea(['id'=>'txt_condition_en','rows' => 6]) ?>
        </div>
        <div class="col col-md-2 align-content-center">
            <?=Html::button('EN',['id'=>'btn_condition_en','class'=>"btn btn-primary btnNoteCond", 'data-toggle'=>"modal" ,'data-target'=>"#frmEditor"]); ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col col-md-10 ">
            <?= Html::textarea('condition_ru', $data['note']['ru']['condition'],['id'=>'txt_condition_ru','class'=>'form-control', 'rows'=>6]) ?>
        </div>
        <div class="col col-md-2 align-content-center">
            <?=Html::button('RU',['id'=>'btn_condition_ru','class'=>"btn btn-primary  btnNoteCond", 'data-toggle'=>"modal" ,'data-target'=>"#frmEditor"]); ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col col-md-10 ">
            <?= Html::textarea('condition_fr', $data['note']['fr']['condition'],['id'=>'txt_condition_fr','class'=>'form-control', 'rows'=>6]) ?>
        </div>
        <div class="col col-md-2 align-content-center">
            <?=Html::button('FR',['id'=>'btn_condition_fr','class'=>"btn btn-primary  btnNoteCond", 'data-toggle'=>"modal" ,'data-target'=>"#frmEditor"]); ?>
        </div>
    </div>

    <?php if($model->id > 0) : ?>
    <div class="form-group row">
        <div class="col col-md">

        <?php
            echo $this->render('_image_grid', [
            'imageSearchModel' => $imageSearchModel,
            'imageDataProvider' => $imageDataProvider,
            ]);
            ?>
        </div>
    </div>
    <?php endif; ?>


    <div class="form-group row">
        <div class="col col-md-10 ">
    <?= $form->field($model, 'comment')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>

  <!-- Modal -->
  <div class="modal fade modal-lg" id="frmEditor" tabindex="-1" role="dialog" aria-labelledby="frmEditorCenterTitle" aria-hidden="true">
      <div class="modal-dialog-scrollable modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="frmEditorLongTitle">Note</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div id="summernote"></div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="btnSaveNote">Save changes</button>
              </div>
          </div>
      </div>
  </div>
