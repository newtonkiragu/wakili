<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PipelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


//dmstr\web\AdminLteAsset::register($this);
//AppAsset::register($this);

$this->title = 'Level Three(Documents)';
//var_dump($filteredJson);die();
?>
<div class="advocates-index">
    <div id="search-form" style="display: none">
        <section class="content">
            <div class="card card-default card-outline">
                <div class="card-header">
                    <h3 class="card-title">Filter By </h3>
                </div> <!-- /.card-body -->
                <div class="card-body">
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                </div><!-- /.card-body -->
            </div>
        </section>

    </div><!-- search-form -->


    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $this->title ?></h3>
            <div class="card-tools">



            </div>

        </div>

        <!-- /.card-header -->
        <div class="card-body">


            <?php
            $buttonOptions = [
                'view' => function ($url) {
                    return Html::a(
                                    '<i class="fa fa-eye"></i> ', $url, [
                                'title' => 'View More...',
                                'data-pjax' => '0',
                                    ]
                    );
                },
                'update' => function ($url) {
                    return Html::a(
                                    '<i class="fa fa-edit"></i> ', $url, [
                                'title' => 'Make Changes..',
                                'data-pjax' => '0',
                                    ]
                    );
                },
                'delete' => function ($url) {
                    return Html::a(
                                    '<i class="fas fa-trash"></i> ', $url, [
                                'data-method' => 'POST',
                                'title' => 'Make Changes..',
                                'data-pjax' => '0',
                                    ]
                    );
                },
            ];



            $gridColumns = [
                ['class' => 'yii\grid\SerialColumn'],
//                'id',
                'name',
//                'description',
                'path',
                'monthlyprice',
                'onetimeamount',
                'annualprice',
                //'is_terminal',
                'level_two_id',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'visible' => Yii::$app->user->can('administrator') ? true : false,
                    'template' => Yii::$app->user->can('administrator') ? '{update}{delete}' : '{update}',
                    'buttons' => $buttonOptions,
                ],
            ];
            ?>

            <?php Pjax::begin(['id' => 'pjax-grid-view']); ?> 
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-condensed'],
                'columns' => $gridColumns,
            ]);
            ?>
            <?php Pjax::end(); ?>


        </div>
    </div>
</div>

<?php
$this->registerCss(""
        . "a { color :#009688 }");
?>



