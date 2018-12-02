<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Levelone */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card card-dafault">


    <div class="card-body">
        <div class="col-md-8" id="statusMessage">

        </div>

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= '<label class="control-label"> Select Level Zero</label>'; ?>
                <?php
                echo Select2::widget([
                    'model' => $model,
                    'data' => ArrayHelper::map(\app\models\Levelzero::find()->asArray()->all(), 'id', 'name'),
                    'attribute' => 'level_zero_id',
//                        'options' => ['placeholder' => 'Search user'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>


            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'monthlyprice')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'annualprice')->textInput(['maxlength' => true]) ?>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?=
                $form->field($model, 'benefits')->widget(CKEditor::className(), [
                    'options' => ['rows' => 6],
                    'preset' => 'basic',
                ])
                ?>
            </div>
        </div>




        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
