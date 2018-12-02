<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */

$this->title = 'Assign Permission to a user';
$this->params['breadcrumbs'][] = ['label' => 'Auth Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
