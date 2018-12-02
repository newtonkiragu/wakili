<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\AccountsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
<div class="row">
    <div class="col-md-4">
         
        
        <?php
                    echo Select2::widget([
                        'model' => $model,
                        'data' => ArrayHelper::map(\app\models\Tbregistration::find()->asArray()->all(), 'id', 'email'),
                        'attribute' => 'userid',
                        'options' => ['placeholder' => 'Search user'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
    </div>
    
</div>
    <br>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
