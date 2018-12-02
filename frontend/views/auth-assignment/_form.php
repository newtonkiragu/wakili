<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="col-xs-12 col-sm-12 col-lg-4">
    <?= $form->field($model, 'item_name')->dropDownList(
            ArrayHelper::map(\frontend\models\AuthItem::find()->all(), 'name', 'name')
           ,['prompt'=>'Select-Role'] ) ?>

    

    
        <?= '<label class="control-label"> HELB STAFF NO</label>'; ?>
        <?php
        echo Select2::widget([
            'model' => $model,
            'data' => ArrayHelper::map(\frontend\models\User::find()->orderBy(['username'=>SORT_ASC])->all(), 'id', 'username'),
            'attribute' => 'user_id',
            'options' => ['placeholder' => 'Select a Member staff...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

      <?= '<br>'; ?>
        <?= Html::submitButton($model->isNewRecord ? 'Assign' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  

    <?php ActiveForm::end(); ?>

</div>
</div>
