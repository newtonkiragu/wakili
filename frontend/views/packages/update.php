<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Packages */

$this->title = 'Update Packages: ' . $model->name;
?>
<div class="packages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
