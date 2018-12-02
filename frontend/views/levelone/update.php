<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Levelone */

$this->title = 'Update Levelone: ' . $model->name;
?>
<div class="levelone-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
