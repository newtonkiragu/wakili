<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tbadvocates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbadvocates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'names')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'practice_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'practice_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_law_firm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'town')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
