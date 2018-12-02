<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Levelzero */

$this->title = 'Update Levelzero: ' . $model->name;
?>
<div class="levelzero-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
