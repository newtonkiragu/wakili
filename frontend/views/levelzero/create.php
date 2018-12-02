<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Levelzero */

$this->title = 'Create Levelzero';
$this->params['breadcrumbs'][] = ['label' => 'Levelzeros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="levelzero-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
