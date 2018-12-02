<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\ConfigurationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configurations-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

<?php $form->field($model, 'id') ?>


    <div class="col-md-6">
        <?= '<label class="control-label"> Select Document</label>'; ?>
        <?php
        echo Select2::widget([
            'model' => $model,
            'data' => ArrayHelper::map(\app\models\Product::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
            'attribute' => 'doc_id',
            'options' => ['placeholder' => 'Select ..'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
    </div>
    
    <br>

    <div class="form-group">
<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
