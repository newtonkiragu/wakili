<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lawfirm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lawfirm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'town')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'building')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'county')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'floor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'practise_areas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
