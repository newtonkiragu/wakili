<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Leveltwo */

$this->title = 'Update Leveltwo: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Leveltwos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="leveltwo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
