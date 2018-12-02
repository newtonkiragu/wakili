<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
$controllerId = Yii::$app->controller->action->controller->id;
$targetController = 'document';



//my variables
$sweeturl = Yii::$app->urlManager->createUrl('js/customstuff/sweetstuff.js');
$loading = Yii::$app->urlManager->createUrl('js/customstuff/jquery-loading-overlay/src/loadingoverlay.min.js');
$bootmenu = Yii::$app->urlManager->createUrl('js/customstuff/bootstrap-menu/dist/BootstrapMenu.min.js');
// var_dump(Yii::$app->controller->action->id);die();
if (Yii::$app->controller->action->id === 'login' || Yii::$app->controller->action->id === 'reset' || Yii::$app->controller->action->id === 'register' || Yii::$app->controller->action->id === 'request') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

     if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);
    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta name="Keywords" content="wakili,m-lawyer,michael mutinda,free law system , law management software,file management system,m-lawyer management software">
        <meta name="Description" content="m-lawyer is development company for law management software in Nairobi. Provide Enterprise solution and quality services.">
        <meta property="og:locale" content="en_US" />
        <meta property="og:title" content="M-lawyer - Provide Enterprise Solution | Development on law management system" />
        <meta property="og:description" content="Core functions like file management, contacts management, expense management, client notification" />

        <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/assets/icons/favicon.png" type="image/x-icon" />
         <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
          <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

            <style>
            h1,h2,h3,h4{
                font-family: 'Montserrat', sans-serif !important;
            }
                .form-group.required .control-label:after {
                    content:"*";
                    color:red;
                }
               
            </style> 
 <?php $this->head() ?>
 
    </head>
    <body  class="<?= \dmstr\helpers\AdminLteHelper::skinClass() ?>" style="font-family: 'Montserrat', sans-serif;" ng-app="mainApp" ng-controller="Controller">
        
        
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= 
            
         $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
 <script src="<?= $sweeturl; ?>"></script>
            <?php
            if ($controllerId == $targetController):
                
                ?>

                <!--                <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/src/loadingoverlay.min.js"></script>
                                <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/extras/loadingoverlay_progress/loadingoverlay_progress.min.js"></script>-->
                <script src="<?= $loading; ?>"></script>
                <script src="<?= $bootmenu; ?>"></script>
                <script src="assets/angularjs/Angular.min.js"></script>
                <script src="assets/angularjs/mainApp.js"></script>
                <script src="assets/angularjs/Controller.js"></script>
                
        <?php
            endif;
            ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
