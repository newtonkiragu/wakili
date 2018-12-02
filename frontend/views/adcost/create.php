<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Adscost */

$this->title = 'Configure Ads Cost';
?>
<div class="adscost-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
