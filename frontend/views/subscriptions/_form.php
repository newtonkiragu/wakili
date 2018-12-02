<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Subscriptions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bg-overlay-loading" id="loader">
    <i class="fas fa-spinner fa-spin" style="font-size: 30px;text-align: center"> </i>   Processing... 

</div>
<div class="card card-dafault">


    <div class="card-body">
        <div class="col-md-8" id="statusMessage">

        </div>


        <?php $form = ActiveForm::begin(['id' => 'sub-form']); ?>
        <div class="row">
            <div class="col-md-3">

                <label class="control-label">Customer</label>
                <div id="value">
                    <?php
                    echo Select2::widget([
                        'model' => $model,
                        'data' => ArrayHelper::map(\app\models\Tbregistration::find()->all(), 'id', 'email', 'phone'),
                        'attribute' => 'userid',
                        'options' => ['placeholder' => 'Search customer', 'id' => 'memberid'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>

                </div>

            </div>
            
             <div class="col-md-3">
                <?= $form->field($model, 'duration')->dropDownList([1=>'Monthly',12=>'Annually'],['maxlength' => true, 'class' => 'form-control form-control-sm']) ?>
            </div>
            
            
            <div class="col-md-3">
                <label class="control-label">Service</label>
                <div id="value">
                    <?php
                    echo Select2::widget([
                        'model' => $model,
                        'data' => ArrayHelper::map(\app\models\Product::find()->all(), 'id', 'name'),
                        'attribute' => 'prodid',
                        'options' => ['placeholder' => 'Search document', 'id' => 'prodid'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>

                </div>
            </div>
           


            <div class="col-md-3">
                <?= $form->field($model, 'amount')->textInput(['maxlength' => true,'readonly'=>true ,'class' => 'form-control form-control-sm']) ?>
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
      var form = $('form#sub-form');
     form.on('submit', function(event) {
     event.preventDefault();
     });
});
$(function(){
      var form = $('form#sub-form');
     form.change( function(event) {
     console.log('form has change');
     var prodid = $('#prodid').val();
     var duration = $('#subscriptions-duration').val();
     
var obj = {id: prodid,duration:duration};
//console.log(obj);
     
      $.get('get-amount', {id: prodid,duration:duration}, function (data) {
              // console.log(data);
                $('#subscriptions-amount').attr('value', data);
                $('#subscriptions-duration').attr('value', data);
                

     });
});
});

    $(function () {

        $('form#sub-form').on('beforeSubmit', function (e) {
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
                  
$('#statusMessage').html('<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><h5><i class=\"icon fa fa-check\"></i> Success !</h5> Subscription is successfully</div>');
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


