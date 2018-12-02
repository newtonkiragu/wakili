<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bg-overlay-loading" id="loader">
    <i class="fas fa-spinner fa-spin" style="font-size: 30px;text-align: center"> </i>   Processing... 

</div>
<div class="card card-dafault">


    <div class="card-body">
        <div class="col-md-8" id="statusMessage">

        </div>
        <?php $form = ActiveForm::begin(['id' => 'prod-form']); ?>
        <div class="row">

            <div class="col-md-4"> 
                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?> 
            </div>
            <div class="col-md-4"> 
                <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?> 
            </div>


        </div>

        <div class="row">
            <div class="col-md-4"> 
                <?=
                $form->field($model, 'level_one', [
                        //  'addon' => ['prepend' => ['content' => '<i class="fa fa-globe icon"></i>']]
                ])->dropDownList(['0' => 'Select One', '1' => 'Standard', '2' => 'Precedents',], ['class' => 'form-control form-control-sm',
                    'onchange' => '
                        console.log($(this).val());
                                 $.post( "' . Yii::$app->urlManager->createUrl('products/lists') . '?id="+$(this).val(), 
                                     function( data ) {
                 $( "select#product-level_two" ).html( data );
                });
                            '])
                ?>
            </div>
            <div class="col-md-4"> 
                <?=
                $form->field($model, 'level_two', [
                        //  'addon' => ['prepend' => ['content' => '<i class="fa fa-globe icon"></i>']]
                ])->dropDownList([], ['class' => 'form-control form-control-sm'])
                ?>
            </div>
            <div class="col-md-4"> 
                <span class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i> </span>  
            </div>


        </div>

        <div class="row">
            <div class="col-md-4"> 
                <?= $form->field($model, 'monthlyprice')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?>
            </div>
            <div class="col-md-4"> 
                <?= $form->field($model, 'annualprice')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?> 
            </div>
            <div class="col-md-4"> 

                <?= $form->field($model, 'fileItem')->fileInput() ?>
            </div>

        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Level Two</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <?php $form = ActiveForm::begin(['id' => 'complete', 'action' => \yii\helpers\Url::to(['leveltwo/create'])]); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?=
                        $form->field($model2, 'level_one', [
                                //  'addon' => ['prepend' => ['content' => '<i class="fa fa-globe icon"></i>']]
                        ])->dropDownList(['1' => 'Standard', '2' => 'Precedents'], ['class' => 'form-control form-control-sm'])
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model2, 'level_two')->textInput(['maxlength' => true, 'class' => 'form-control form-control-sm']) ?>
                    </div>
                </div>


            </div>
            <div class="modal-footer">

                <?= Html::button('Save changes', ['class' => 'btn btn-success', 'id' => 'btnSave']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>



<?php $this->registerJs(" 
    //form submission



    $(function () {
        var form = $('form#prod-form');
        form.on('submit', function (event) {
            event.preventDefault();
        });
    });


    $(function () {

        $('form#prod-form').on('beforeSubmit', function (e) {
            $('#loader').show();
            var form = $(this);

            $.ajax({
                type: 'post',
                url: form.attr('action') + '?XDEBUG_SESSION_START=netbeans-xdebug',
                data: new FormData(form[0]),
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {
                    $('#loader').hide();
                    if (result == 'success') {
                        $('#statusMessage').html('<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><h5><i class=\"icon fa fa-check\"></i> Success !</h5> Product has been added successfully</div>');
                    } else {

                        $('#statusMessage').html('<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><h5><i class=\"icon fa fa-ban\"></i> Input Error !</h5>' + result + '</div>');
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
    $(function () {



        $('#btnSave').on('click', function (e) {
            $('#loader').show();
            var form = $('form#complete');

            $.ajax({
                type: 'post',
                url: form.attr('action') + '?XDEBUG_SESSION_START=netbeans-xdebug',
                data: new FormData(form[0]),
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {
                    $('#loader').hide();
                    console.log(result);
                    $('#exampleModalCenter').modal('hide');
                    res = JSON.parse(result);
                    if (!res.error) {
                        console.log(res.message);
                        var message = res.message;
                        $('select#product-level_two').append('<option value=\"'+message+'\">'+message+'</option>');
                    } else {

                        $('#statusMessage').html('<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><h5><i class=\"icon fa fa-ban\"></i> Input Error !</h5>' + result + '</div>');
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
")?>


