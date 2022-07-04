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

<div class="best-for-you-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-12 col-md-5">
            <div class="row">
                <?= $form->field($model, 'photo')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'
                    ],
                    'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],'showUpload' => false
                        , 'previewFileType' => 'image'
                     ,'initialPreview'=>[

                            '<img src="'.$model->photo."?".time().'" class="file-preview-image">',
                        ]

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
                    <div class="col-4 col-md-4 ">
                        <?= $form->field($model, 'row')->textInput(['type'=>'number','max' => '4', 'min'=>'1' , 'step' => '1']) ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6 col-md-6 ">
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

