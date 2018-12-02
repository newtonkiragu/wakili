<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tbadvocates */

$this->title = 'Create Tbadvocates';
$this->params['breadcrumbs'][] = ['label' => 'Tbadvocates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbadvocates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
