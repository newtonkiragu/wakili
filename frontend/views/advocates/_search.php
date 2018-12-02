<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TbadvocatesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbadvocates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    
     <div class="row">
     <div class="col-md-3">
              <?= $form->field($model, 'names') ?>
     </div>
     <div class="col-md-3">
            <?= $form->field($model, 'practice_no') ?>
     </div>
     <div class="col-md-3">
            <?= $form->field($model, 'tel_no') ?>
     </div>
     <div class="col-md-3">
            <?= $form->field($model, 'current_law_firm') ?>
     </div>
 </div>

   

   


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
