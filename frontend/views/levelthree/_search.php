<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LevelthreeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="levelthree-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'path') ?>

    <?= $form->field($model, 'monthlyprice') ?>

    <?php // echo $form->field($model, 'onetimeamount') ?>

    <?php // echo $form->field($model, 'annualprice') ?>

    <?php // echo $form->field($model, 'is_terminal') ?>

    <?php // echo $form->field($model, 'level_two_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
