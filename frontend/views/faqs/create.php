<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Faqs */

$this->title = 'Add Faqs';
?>
<div class="faqs-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
