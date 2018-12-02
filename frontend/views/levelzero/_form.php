<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Levelzero */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card card-dafault">


    <div class="card-body">
        <div class="col-md-8" id="statusMessage">

        </div>

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            
            <div class="col-md-6">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'usertype')->dropDownList([1=>'GENERAL USER',2=>'ADVOCATE',3=>'LAW FIRM']) ?>
            </div>
        </div>
        

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
