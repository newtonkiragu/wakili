<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Constitution */

$this->title = 'Add Chapter';
?>
<div class="constitution-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
