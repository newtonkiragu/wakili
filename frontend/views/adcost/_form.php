<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Adscost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card card-dafault">


    <div class="card-body">
        <div class="col-md-8" id="statusMessage">

        </div>

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'time')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
