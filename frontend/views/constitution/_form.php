<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Constitution */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="constitution-form">


    <div class="card card-dafault">


        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


            <?=
            $form->field($model, 'description')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'basic',
            ])
            ?>




        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
</div>
