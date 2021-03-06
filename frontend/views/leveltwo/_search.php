<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LeveltwoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leveltwo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'path') ?>

    <?= $form->field($model, 'monthlyprice') ?>

    <?php // echo $form->field($model, 'annualprice') ?>

    <?php // echo $form->field($model, 'is_terminal') ?>

    <?php // echo $form->field($model, 'level_one_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
