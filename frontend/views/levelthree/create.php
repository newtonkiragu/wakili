<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Levelthree */

$this->title = 'Upload Document';
?>
<div class="levelthree-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
