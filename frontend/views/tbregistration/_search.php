<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TbregistrationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbregistration-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        
        <div class="col-md-4">
             <?= $form->field($model, 'email')->textInput(['class'=>'form-control form-control-sm']) ?>
        </div>
        <div class="col-md-4">
             <?= $form->field($model, 'phone')->textInput(['class'=>'form-control form-control-sm']) ?>
        </div>
    </div>
   

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
