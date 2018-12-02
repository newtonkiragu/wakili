<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Leveltwo */

$this->title = 'Create Leveltwo';
?>
<div class="leveltwo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
