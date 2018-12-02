<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Adscost */

$this->title = 'Update Adscost: ' . $model->id;
?>
<div class="adscost-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
