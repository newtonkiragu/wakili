<?php

use app\models\TblCust;
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Yii::$app->urlManager->createUrl('/') ?>" class="brand-link">
        <img src="<?= Yii::$app->urlManager->createUrl('img/icon.jpg') ?>" alt="AdminLTE Logo" class="brand-image elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo Yii::$app->name; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= Yii::$app->urlManager->createUrl('img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info" style="color:#ffffff">
                <?php
                if (!Yii::$app->user->isGuest) {
                    $staffno = Yii::$app->user->identity->username;
                    $userfullnames = $staffno;
                } else {
                    $userfullnames = "Guest";
                }
                echo \yii\helpers\Inflector::camel2words($userfullnames);
                ?>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul style="font-size: 14px !important" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->



                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gavel"></i>
                        <p>
                            Advocates
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <!--                        <li class="nav-item">
                                                    <a href="<?= Yii::$app->urlManager->createUrl('advocates/create') ?>" class="nav-link">
                                                        <i class="far fa-calendar-plus nav-icon"></i>
                                                        <p>Create Advocate</p>
                                                    </a>
                                                </li>-->
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('advocates') ?>" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>View Advocates</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="<?= Yii::$app->urlManager->createUrl('tbregistration') ?>" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Users

                        </p>
                    </a>

                </li>
                <li class="nav-item has-treeview">
                    <a href="<?= Yii::$app->urlManager->createUrl('lawfirm') ?>" class="nav-link">
                        <i class="nav-icon fa fa-university"></i>
                        <p>
                            Law firms

                        </p>
                    </a>

                </li>


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-question"></i>
                        <p>
                            FAQs
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('faqs/create') ?>" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add FAQs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('faqs') ?>" class="nav-link">
                                <i class="fa fa-question nav-icon"></i>
                                <p>View FAQs</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            Constitution
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('constitution/create') ?>" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Chapter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('constitution') ?>" class="nav-link">
                                <i class="fa fa-question nav-icon"></i>
                                <p>View Chapters</p>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-newspaper"></i>
                        <p>
                            Subscriptions
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <!--                        <li class="nav-item">
                                                    <a href="<?= Yii::$app->urlManager->createUrl('subscriptions/create') ?>" class="nav-link">
                                                        <i class="fa fa-plus nav-icon"></i>
                                                        <p>Add Subscription</p>
                                                    </a>
                                                </li>-->
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('subscriptions') ?>" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Subscriptions</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-gift"></i>
                        <p>
                            Packages
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('packages/create') ?>" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Package</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('packages') ?>" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Packages</p>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Documents
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('levelthree/create') ?>" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Document</p>
                            </a>
                        </li>
                                

                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-pencil-square"></i>
                        <p>
                            Configurations
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('configurations/create') ?>" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Configuration</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('configurations') ?>" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>View Configuration </p>
                            </a>
                        </li>                      

                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>
                            Accounts
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('accounts') ?>" class="nav-link">
                                <i class="fa fa-money nav-icon"></i>
                                <p>View Accounts</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-money"></i>
                        <p>
                            Transactions
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('transactions') ?>" class="nav-link">
                                <i class="fa fa-money nav-icon"></i>
                                <p>View Transactions</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-buysellads"></i>
                        <p>
                            ADS
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('ads/create') ?>" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Advert</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('adcost/create') ?>" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Configure Ads Cost</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('ads') ?>" class="nav-link">
                                <i class="fab fa-buysellads nav-icon"></i>
                                <p>View ADS</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa fa-tree"></i>
                        <p>
                            Levels
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('levelzero') ?>" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>Level zero</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('levelone') ?>" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>Level One </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('leveltwo') ?>" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>Level two </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('levelthree') ?>" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>Level Three (Documents) </p>
                            </a>
                        </li>


                    </ul>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>