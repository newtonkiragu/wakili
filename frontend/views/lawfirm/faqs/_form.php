
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Clients */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="bg-overlay-loading" id="loader">
        <i class="fas fa-spinner fa-spin" style="font-size: 30px;text-align: center"> </i>   Processing... 
        
    </div>
<div class="card card-dafault">
   
   
    <div class="card-body">
        <div class="col-md-8" id="statusMessage">
             
        </div>
       
        
        <?php
        $form = ActiveForm::begin([
                    'id' => 'faq-form',
        ]);
        ?>
  <div class="row">
       <div class="col-md-4">
            <?= $form->field($model, 'title')->textInput(['class'=>'form-control form-control-sm']) ?>
        </div>
       <div class="col-md-4">
            <?= $form->field($model, 'description')->textarea(['rows' => 6,'class'=>'form-control form-control-sm']) ?>
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
      var form = $('form#faq-form');
     form.on('submit', function(event) {
     event.preventDefault();
     });
});

    $(function () {


        $('form#faq-form').on('beforeSubmit', function (e) {
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
$('#statusMessage').html('<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><h5><i class=\"icon fa fa-check\"></i> Success !</h5> FAQs has been added successfully</div>');
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

