<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Add Product';
?>
<div class="product-create">

  
    <?= $this->render('_form', [
        'model' => $model,
        'model2' => $model2,
    ]) ?>

</div>
