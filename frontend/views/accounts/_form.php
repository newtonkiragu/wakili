<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Accounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <?= $form->field($model, 'opening_bal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'actual_bal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'available_bal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
