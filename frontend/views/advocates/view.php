<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tbadvocates */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbadvocates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbadvocates-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'names',
            'practice_no',
            'practice_area',
            'current_law_firm',
            'tel_no',
            'email:email',
            'town',
        ],
    ]) ?>

</div>
