<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Levelthree */

$this->title = 'Update Levelthree: ' . $model->name;
?>
<div class="levelthree-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_1', [
        'model' => $model,
    ]) ?>

</div>
