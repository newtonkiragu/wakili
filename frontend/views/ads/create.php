<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ads */

$this->title = 'Add Advertisement';
?>
<div class="ads-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
