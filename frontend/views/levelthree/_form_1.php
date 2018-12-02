<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Levelthree */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="bg-overlay-loading" id="loader">
    <i class="fas fa-spinner fa-spin" style="font-size: 30px;text-align: center"> </i>   Processing... 

</div>
<div class="card card-dafault">


    <div class="card-body">
        <div class="col-md-8" id="statusMessage">

        </div>

        <?php $form = ActiveForm::begin(['id'=>'prod-form']); ?>

        <div class="row">
            <div class="col-md-4">
                   <?= '<label class="control-label"> Select Document</label>'; ?>
        <?php
                    echo Select2::widget([
                        'model' => $model,
                        'data' => ArrayHelper::map(\app\models\Leveltwo::find()->asArray()->all(), 'id', 'name'),
                        'attribute' => 'level_two_id',
//                        'options' => ['placeholder' => 'Search user'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>


            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'monthlyprice')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'annualprice')->textInput(['maxlength' => true]) ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                        <?= $form->field($model, 'onetimeamount')->textInput(['maxlength' => true]) ?>

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
                        $('#statusMessage').html('<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><h5><i class=\"icon fa fa-check\"></i> Success !</h5> Document has been added successfully</div>');
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