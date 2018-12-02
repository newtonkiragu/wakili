<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login' || Yii::$app->controller->action->id === 'register' || Yii::$app->controller->action->id === 'request' || Yii::$app->controller->action->id === 'resend') {
    /**
     * Do not use this code in your template. Remove it. 
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    echo $this->render(
            'main-login', ['content' => $content]
    );
} else {

//    frontend\assets\AppAsset::register($this);
//    dmstr\web\AdminLteAsset::register($this);
    frontend\assets\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@webroot/upgrade/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
        <head>
            <meta charset="<?= Yii::$app->charset ?>"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="x-ua-compatible" content="ie=edge">
            <meta name="Keywords" content="wakili,m-lawyer,michael mutinda,free law system , law management software,file management system,m-lawyer management software">
            <meta name="Description" content="m-lawyer is development company for law management software in Nairobi. Provide Enterprise solution and quality services.">
            <meta property="og:locale" content="en_US" />
            <meta property="og:title" content="M-lawyer - Provide Enterprise Solution | Development on law management system" />
            <meta property="og:description" content="Core functions like file management, contacts management, expense management, client notification" />

           

            <link rel="apple-touch-icon" sizes="152x152" href="<?php echo Yii::$app->request->baseUrl; ?>/img/apple-touch-icon.png">
            <link rel="icon" type="image/png" sizes="32x32" href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="16x16" href="<?php echo Yii::$app->request->baseUrl; ?>/img/favicon-16x16.png">
            <link rel="manifest" href="/site.webmanifest">
            <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
            <meta name="msapplication-TileColor" content="#da532c">
            <meta name="theme-color" content="#ffffff">


            <!-- Font Awesome -->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
            <!-- Ionicons -->
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <?= Html::csrfMetaTags() ?>
            <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
        </head>
        <!--<body class="sidebar-mini sidebar-collapse">-->
        <body class="hold-transition sidebar-mini">
    <?php $this->beginBody() ?>

            <div class="wrapper">

    <?=
    $this->render(
            'header.php', ['directoryAsset' => $directoryAsset]
    )
    ?>

                <?=
                $this->render(
                        'left.php', ['directoryAsset' => $directoryAsset]
                )
                ?>

                <?=
                $this->render(
                        'content.php', ['content' => $content, 'directoryAsset' => $directoryAsset]
                )
                ?>

            </div>

    <?php $this->endBody() ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.4/jspdf.plugin.autotable.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.1/shim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.1/xlsx.full.min.js"></script>
        </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>


