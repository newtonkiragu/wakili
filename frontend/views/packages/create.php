<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Packages */

$this->title = 'Add Packages';
?>
<div class="packages-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
