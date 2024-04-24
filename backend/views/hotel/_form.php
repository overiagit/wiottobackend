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
            <?= $form->field($model, 'country_id')->textInput(['readonly'=>true,'id'=>'txtCountryId']) ?>
        </div>
        <div class="col-6 col-md-8">
            <?= $form->field($model, 'country_id')->dropDownList(
                [582=>"Maldives", 217=>"Indonesia", 82=>"Seychelles"],
                ['prompt' => '', 'id' => 'select-country_id','onChange'=>'
                     $("#txtCountryId").val(this.value);
                      $("#hotel-country_id").val(this.value);
                     updateTownOptions(this.value);
                     updateTownRegionOptions(this.value);
                     updateIslandOptions(this.value);
                     updateFeatureOptions(this.value);
                    ']
            )->label('Country') ?>
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
        <div class="col-10">
        <?= $form->field($model, 'features'
        )->widget(Select2::classname(), [
            'data' =>$data['feature_list'], //\yii\helpers\ArrayHelper::map($data['feature_list'], 'id', 'value'),
            'options' => ['placeholder' => Yii::t('app', 'Feature')  ,'allowClear' => true, 'id'=>'cbFeature'
            , 'name'=>'Hotel[Features1]' ,'multiple' => true, 'disabled'=>true,
                'class' => "form-control select2-show-search  border-bottom-0",
            ],
            'pluginOptions' => [
                           'allowClear' => true,
                'width' => '100%',
'disabled'=>true,
                'theme'=>'material',
            ],
        ])->label(false) ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-10">
            <?= $form->field($model, 'features')->checkboxList(
                    $data['feature_list']);
                    ?>
        </div>
        </div>

    <div class="form-group row">
        <div class="col col-md-10">
        <?= $form->field($model, 'note')->textarea(['id'=>'txt_note','rows' => 6]) ?>
        </div>
        <div class="col col-md-2 align-content-center">
             <?=Html::button('NOTE',['id'=>'btn_note_en','class'=>"btn btn-primary btnNoteCond", 'data-toggle'=>"modal" ,'data-target'=>"#frmEditor"]); ?>
        </div>
    </div>
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
    <?= $form->field($model, 'country_id')->hiddenInput()->label(false); ?>
    <div class="form-group row">
        <div class="col col-md-10">
            <?= $form->field($model, 'condition')->textarea(['id'=>'txt_condition','rows' => 6]) ?>
        </div>
        <div class="col col-md-2 align-content-center">
            <?=Html::button('CONDITION',['id'=>'btn_condition_en','class'=>"btn btn-primary btnNoteCond", 'data-toggle'=>"modal" ,'data-target'=>"#frmEditor"]); ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col col-md-10">
            <?= Html::textarea('condition_en', $data['note']['en']['condition'],['id'=>'txt_condition_en','class'=>'form-control', 'rows'=>6]) ?>
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


  <script>
      function updateTownOptions(countryId) {
          // Make an AJAX request to fetch towns based on the selected country
          $.ajax({
              url: `/hotel/town/` + countryId,
              type: 'GET',
              // data: {countryId: countryId},
              success: function (data) {
                  // Update the options in the town dropdown
                  // $("#select-town_id").html(data);
                  const select = $("#select-town_id");
                  select.empty(); // Clear existing options

                  // Add prompt option if needed
                  select.append('<option value="">Select Town</option>');

                  // Loop through the JSON data and add options
                  $.each(JSON.parse(data), function(id, option) {
                      select.append('<option value="' + id + '">' + option + '</option>');
                  });

              },
              error: function () {
                  console.error('Error fetching towns');
              }
          });
      }


      function updateTownRegionOptions(countryId) {
          // Make an AJAX request to fetch towns based on the selected country
          $.ajax({
              url: `/hotel/town-region/` + countryId,
              type: 'GET',
              // data: {countryId: countryId},
              success: function (data) {
                  // Update the options in the town dropdown
                  // $("#select-town_region_id").html(data);

                  const select = $("#select-town_region_id");
                  select.empty(); // Clear existing options

                  // Add prompt option if needed
                  select.append('<option value="">Select Town region</option>');

                  // Loop through the JSON data and add options
                  $.each(JSON.parse(data), function(id, option) {
                      select.append('<option value="' + id + '">' + option + '</option>');
                  });
              },
              error: function () {
                  console.error('Error fetching towns');
              }
          });
      }

      function updateIslandOptions(countryId) {
          // Make an AJAX request to fetch islands based on the selected country
          $.ajax({
              url: `/hotel/island/` + countryId,
              type: 'GET',
              // data: {countryId: countryId},
              success: function (data) {
                  // Update the options in the island dropdown
                  // $("#select-island_id").html(data);

                  const select = $("#select-island_id");
                  select.empty(); // Clear existing options

                  // Add prompt option if needed
                  select.append('<option value="">Select Island</option>');

                  // Loop through the JSON data and add options
                  $.each(JSON.parse(data), function(id, option) {
                      select.append('<option value="' + id + '">' + option + '</option>');
                  });
              },
              error: function () {
                  console.error('Error fetching islands');
              }
          });
      }


      function updateFeatureOptions(countryId) {
          // Make an AJAX request to fetch features based on the selected country
          $.ajax({
              url: '/hotel/feature/' + countryId,
              type: 'GET',
             // data: {countryId: countryId},
              dataType: 'json',
              success: function (data) {
                  // Update the options in the Select2 dropdown
                  var cbFeature = $("#cbFeature");

                  // Clear existing options
                  cbFeature.empty();

                  // Add prompt option if needed
                  cbFeature.append('<option value=""></option>');

                  // Loop through the JSON data and add options
                  $.each((data), function(id, option) {
                      cbFeature.append(new Option(option, id, false, false));
                  });

                  // Trigger change event to update Select2
                  cbFeature.trigger('change');
              },
              error: function () {
                  console.error('Error fetching features');
              }
          });
      }
  </script>
