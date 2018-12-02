<?php

use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'PERMISSION Assignment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Assign Rights', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'item_name',
            [
                 'attribute'=>'item_name',
                 'value'=>'item_name',
                 
             ] ,
            

            [
                 'attribute'=>'user_id',
                 'value'=>'staffName.username',
                
             ] ,
             [
                 'attribute'=>'created_at',
                 'value'=>'created_at',
                 
             ] ,
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    
</div>
