<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Lawfirm */

$this->title = 'Create Lawfirm';
$this->params['breadcrumbs'][] = ['label' => 'Lawfirms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lawfirm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
