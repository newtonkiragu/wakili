<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Ads */
/* @var $form yii\widgets\ActiveForm */

$selectdata = ArrayHelper::map(\app\models\Adscost::find()->asArray()->all(), 'time', 'amount');


$processedData= array();
foreach ($selectdata as $key => $value) {
    
    $processedData[$key] = "KES  ".$value ." for ".$key. " milliseconds";
    
}

//var_dump($processedData);die();
?>

<div class="bg-overlay-loading" id="loader">
    <i class="fas fa-spinner fa-spin" style="font-size: 30px;text-align: center"> </i>   Processing... 

</div>
<div class="card card-dafault">


    <div class="card-body">
        <div class="col-md-8" id="statusMessage">

        </div>


        <?php
        $form = ActiveForm::begin(['id' => 'ads-form']);
        ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'fileItem')->fileInput()->label('Upload advert image') ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <?=
                $form->field($model, 'job_description')->widget(CKEditor::className(), [
                    'options' => ['rows' => 6],
                    'preset' => 'basic',
                ])
                ?>

            </div>
            <div class="col-md-6">
                <?=
                $form->field($model, 'qualification')->widget(CKEditor::className(), [
                    'options' => ['rows' => 6],
                    'preset' => 'basic',
                ])
                ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-6">
                <?= '<label class="control-label"> Select Amount</label>'; ?>
                <?php
                echo Select2::widget([
                    'model' => $model,
                    'data' => $processedData,
                    'attribute' => 'time',
                    'options' => ['placeholder' => 'Select ..'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>


        </div>


        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>


<?php $this->registerJs(" 
    //form submission



$(function(){
      var form = $('form#ads-form');
     form.on('submit', function(event) {
     event.preventDefault();
     });
});

    $(function () {


        $('form#ads-form').on('beforeSubmit', function (e) {
        $('#loader').show();
            var form = $(this);
         

            $.ajax({
                type: 'post',
                url: form.attr('action'),
                data: new FormData(form[0]),
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {
                  console.log(result);
                 $('#loader').hide();
                    if (result == 'success') {
                  
                        form.trigger('reset');
$('#statusMessage').html('<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><h5><i class=\"icon fa fa-check\"></i> Success !</h5> Advert has been added successfully</div>');
                    } else {
                     
                        $('#statusMessage').html('<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><h5><i class=\"icon fa fa-ban\"></i> Input Error !</h5>'+result+'</div>');
                    }
                }
                ,
                error: function () {
                 $('#loader').hide();
                    return 'An Error Occured!';
                }
            });


        });
    });

") ?>


