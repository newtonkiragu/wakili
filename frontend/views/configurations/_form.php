<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Configurations */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="bg-overlay-loading" id="loader">
        <i class="fas fa-spinner fa-spin" style="font-size: 30px;text-align: center"> </i>   Processing... 
        
    </div>
<div class="card card-dafault">
   
   
    <div class="card-body">
        <div class="col-md-8" id="statusMessage">
             
        </div>
       

    <?php $form = ActiveForm::begin(['id'=>'formConfigurations']); ?>

  
    <div class="row">

        <div class="col-md-6">
            <?= '<label class="control-label"> Select Document</label>'; ?>
            <?php
            echo Select2::widget([
                'model' => $model,
                'data' => ArrayHelper::map(\app\models\Levelthree::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
                'attribute' => 'doc_id',
                'options' => ['placeholder' => 'Select ..'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                <?= $form->field($model, 'item')->textInput() ?>

        </div>
      
    </div>
    <div class="row">
     
        <div class="col-md-6">
                <?= $form->field($model, 'value')->textInput()  ?>

        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>




<?php $this->registerJs(" 
    //form submission



$(function(){
      var form = $('form#formConfigurations');
     form.on('submit', function(event) {
     event.preventDefault();
     });
});

    $(function () {


        $('form#formConfigurations').on('beforeSubmit', function (e) {
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
$('#statusMessage').html('<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><h5><i class=\"icon fa fa-check\"></i> Success !</h5> Configuration has been set </div>');
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

