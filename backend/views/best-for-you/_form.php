  <?php

  use kartik\file\FileInput;
  use kartik\select2\Select2;
  use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BestForYou */
/* @var $data array */
  /* @var $features array*/
/* @var $form yii\widgets\ActiveForm */
 /* @var $imageSearchModel backend\models\HotelImageSearch */
 /* @var $imageDataProvider yii\data\ActiveDataProvider */



  \backend\assets\AppAssetSummerNote::register($this);
?>

<!--  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">-->
<!--  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>-->

<div class="best-for-you-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-12 col-md-5">
            <div class="row">
                <?= $form->field($model, 'photo')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'
//                        , 'overwriteInitial'=>false
                    ],
                    'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],'showUpload' => false
                        , 'previewFileType' => 'image'
                     ,'initialPreview'=>[
//                            $model->photo ?  Html::img($model->photo) : null
                            '<img src="'.$model->photo."?".time().'" class="file-preview-image">',
                        ]
//                     ,'initialPreviewAsData'=>t,
                        ],
                ]);   ?>
            </div>
        </div>
        <div class="col-12 col-md-7">

                <div class="form-group row">
                    <div class="col col-md-2 ">
                    <?= $form->field($model, 'id')->textInput(['readonly'=>true]) ?>
                    </div>
                </div>
            <div class="form-group row">
                <div class="col col-md-10">
<!--                    <label for="txt_note_en">Note EN</label>-->
<!--                    --><?//= Html::textInput('note_en', $data['note']['en'],['id'=>'txt_note_en','class'=>'form-control']) ?>
                    <?= $form->field($model, 'note')->textInput(['maxlength' => true])->label('Note EN') ?>
                </div>
            </div>
                <div class="form-group row">
                    <div class="col col-md-10 ">
                        <label for="txt_note_ru">Note RU</label>
                        <?= Html::textInput('note_ru', $data['ru']['note'],['id'=>'txt_note_ru','class'=>'form-control'])
                        ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col col-md-10">
                        <label for="txt_note_ru">Note FR</label>
                        <?= Html::textInput('note_fr', $data['fr']['note'],['id'=>'txt_note_fr','class'=>'form-control']) ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col col-md-10 ">
                    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col col-md-10 ">
                    <?= $form->field($model, 'active')->checkbox() ?>
                    </div>
                </div>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'style'=>'width:200px']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

