<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Packages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bg-overlay-loading" id="loader">
    <i class="fas fa-spinner fa-spin" style="font-size: 30px;text-align: center"> </i>   Processing... 

</div>
<div class="card card-dafault">


    <div class="card-body">
        <div class="col-md-8" id="statusMessage">

        </div>

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <?=
                $form->field($model, 'benefits')->widget(CKEditor::className(), [
                    'options' => ['rows' => 6],
                    'preset' => 'basic',
                ])
                ?>

            </div>


        </div>

        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'monthly')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'annualamount')->textInput(['maxlength' => true]) ?>
            </div>
        </div>




        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
