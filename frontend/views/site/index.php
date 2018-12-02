<?php
/* @var $this yii\web\View */

use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\Highstock;
use miloschuman\highcharts\SeriesDataHelper;
use yii\web\JsExpression;

//$this->title = 'Dashboard:: ' . Yii::$app->name;
$this->title = 'Dashboard';
?>

<div class="site-index">

    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $noofadvocates ?></h3>

                    <p>Advocates</p>
                </div>
                <div class="icon">
                    <i class="fa fa-gavel"></i>
                </div>
                <a href="<?= Yii::$app->urlManager->createUrl('advocates') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $no_of_docs ?><sup style="font-size: 20px"></sup></h3>

                    <p>Documents</p>
                </div>
                <div class="icon">
                    <i class="fa fa-folder"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $no_of_useraccount; ?></h3>

                    <p>Users Accounts</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?= Yii::$app->urlManager->createUrl('tbregistration') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= $no_of_lawfirms; ?></h3>

                    <p>Law firms</p>
                </div>
                <div class="icon">
                    <i class="fa fa-university"></i>
                </div>
                <a href="<?= Yii::$app->urlManager->createUrl('lawfirm') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Latest MPESA payments</h3>


                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Phone</th>
                                    <th>Amount</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($alltransactions as $key => $value) : ?>
                                    <tr>
                                        <td><a href="#"><?= $value['ref'] ?></a></td>
                                        <td><?= $value['phone'] ?></td>
                                        
                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $value['amount'] ?></div>
                                        </td>
                                        
                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $value['message'] ?></div>
                                        </td>
                                        
                                        <td><span class="badge <?= $value['status'] == "1" ? "badge-success":"badge-danger" ?>"><?= $value['status'] == "0" ? "Pending":"" ?><?= $value['status'] == "1" ? "complete":"" ?><?= $value['status'] == "2" ? "Failed":"" ?></span></td>
                                    </tr>

                                <?php endforeach; ?>



                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="<?= Yii::$app->urlManager->createUrl('transactions') ?>" class="btn btn-sm btn-secondary float-right">View All payments</a>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
    </div>


</div> 






