<?php
use yii\helpers\Html;
use app\models\TblCust;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<?php
if (!Yii::$app->user->isGuest) {
    $staffno = Yii::$app->user->identity->username;
    $recordone = TblCust::findOne(['Staffno' => $staffno]);
    $userfullnames =  strtoupper($recordone->cust_F_Name) . '  ' . strtoupper($recordone->cust_L_Name);
    if(Yii::$app->user->can('administrator')){
        $role = "ADMINISTRATOR";

    }else{
        $role = "MEMBER";
    }
}else{
    $userfullnames = "Michael Mutinda";
    $role = "MEMBER";
}



$showimage = false;
$staffname = Yii::$app->user->identity->username;
$stringForImage = 'assets/profile/'.$staffname.'.jpg';
  

$imgpath = Yii::getAlias('@webroot').'/assets/profile/'.$staffname.'.jpg';


if(file_exists($imgpath)){

    $imgurl = Yii::$app->urlManager->createUrl($stringForImage).'?dummy='.mt_rand(10,100);
}else{
    $imgurl = Yii::$app->urlManager->createUrl('assets/icons/user.png').'?dummy='.mt_rand(10,100);

}

?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo','style'=>['font-size'=>'25px','font-family'=>'Gloria Hallelujah']]) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

               
                <!-- Messages: style can be found in dropdown.less-->
                      <!--   <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-success">1</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 1 notification(s)</li>
                                <li>
                                    inner menu: contains the actual data
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> Welcome to Phundament 4!
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li> -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span class="hidden-xs"><?= $userfullnames;?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img id="bigprof" src="<?= $imgurl ?>" class="img-circle"
                                 alt="User Image"/>
                                
            

                            
                              <p>  <?= $userfullnames?>- <?=$role;?>

                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= Yii::$app->urlManager->createUrl('user/settings/account')?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Log off',
                                    ['/auth/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
