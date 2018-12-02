<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tbregistration */

$this->title = 'Create Tbregistration';
$this->params['breadcrumbs'][] = ['label' => 'Tbregistrations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbregistration-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
