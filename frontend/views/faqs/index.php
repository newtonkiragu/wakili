<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PipelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


//dmstr\web\AdminLteAsset::register($this);
//AppAsset::register($this);

$this->title = 'Faqs';
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

                <div class="btn-group">
                    <button type="button" class="btn btn-tool" id="search-button" title="Search..">
                        <i class="fas fa-search"></i>
                    </button>
                    <button type="button" class="btn btn-tool" id="refresh-button" title="Refresh grid">
                        <i class="fas fa-repeat"></i>
                    </button>
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" title="Export Data">
                        <i class="fas fa-file"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a href="#" class="dropdown-item" id="pdf-button">Download PDF</a>
                        <a href="#" class="dropdown-item" id="pdf-excel">Download Excel</a>

                    </div>
                </div>

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
//                        'id',
           'title',
            'description:ntext',
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

        <?php $url = Yii::$app->urlManager->createUrl('site/downloadfile') ?>

        <?php
        $js = <<<JS
    var title = '$this->title';

    $('#search-button').click(function () {
        $('#search-form').toggle();
    });
    $('#refresh-button').click(function () {
        $.pjax({container: '#pjax-grid-view'})
    });

    $('#pdf-button').click(function () {
        var stringdata = $filteredJson;
        var rows = stringdata;
        // console.log('data parsed',dataparsed);
        var columns = JSON.parse('$columns');
        // console.log('columns',columns);

// Only pt supported (not mm or in)
        var doc = new jsPDF('p', 'pt');
        doc.autoTable(columns, rows, {
            theme: 'grid',
            styles: {overflow: 'linebreak', columnWidth: 'wrap', cellPadding: 2, fontSize: 9},
            margin: {horizontal: 7},
            bodyStyles: {valign: 'top'},
            columnStyles: {text: {columnWidth: 'auto'}},
            addPageContent: function (data) {
                doc.setFont('courier')
                doc.setFontType('bolditalic')
                doc.text(40, 30, title + ' report')
            }
        });
        doc.save(title + '.pdf');


    });
    $('#pdf-excel').click(function () {
        //Excel file

        /* original data */
        var filename = title + ".xlsx";
        var columns = JSON.parse('$columnsExcel');
//console.log('columns',columns);
        var mainArrFilteredData = $mainArrFilteredDataExcel;
        mainArrFilteredData.unshift(columns);
        var ws_name = "SheetJS";
        console.log(mainArrFilteredData);

        if (typeof console !== 'undefined')
            console.log(new Date());
        var wb = XLSX.utils.book_new(), ws = XLSX.utils.aoa_to_sheet(mainArrFilteredData);

        /* add worksheet to workbook */
        XLSX.utils.book_append_sheet(wb, ws, ws_name);

        /* write workbook */
        if (typeof console !== 'undefined')
            console.log(new Date());
        XLSX.writeFile(wb, filename);
        if (typeof console !== 'undefined')
            console.log(new Date());

    });
JS;
        $this->registerJs($js);
        $this->registerCss(""
                . "a { color :#009688 }");
        ?>

