<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Update Product: ' . $model->name;
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_1', [
        'model' => $model,
        'model2' => $model2,
    ]) ?>

</div>
