<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Configurations */

$this->title = 'Add Configurations';
?>
<div class="configurations-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
