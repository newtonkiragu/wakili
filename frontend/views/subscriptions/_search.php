<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\SubscriptionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscriptions-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>
    <div class="row">
        <div class="col-md-3">
            <label class="control-label">Customer</label>
            <?php
            echo Select2::widget([
                'model' => $model,
                'data' => ArrayHelper::map(\app\models\Tbregistration::find()->asArray()->all(), 'id', 'email'),
                'attribute' => 'userid',
                'options' => ['placeholder' => 'Search user', 'class' => 'form-control form-control-sm'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <label class="control-label">Product</label>
            <?php
            echo Select2::widget([
                'model' => $model,
                'data' => ArrayHelper::map(\app\models\Product::find()->asArray()->all(), 'id', 'name'),
                'attribute' => 'prodid',
                'options' => ['placeholder' => 'Search product', 'class' => 'form-control form-control-sm'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'amount')->textInput(['class' => 'form-control form-control-sm']) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
