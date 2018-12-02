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

if (Yii::$app->controller->action->id === 'login' || Yii::$app->controller->action->id === 'register') { 
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
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
          <link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

            <style>
                .form-group.required .control-label:after {
                    content:"*";
                    color:red;
                }
                .alert-danger{
                    background-color: blue;
                }
                #demo-device-ios, #demo-device-android, #demo-device-windows {
    width: 467px;
    height: 600px;
    background: center top no-repeat url(/lawyer/assets/icons/devices-sprite.jpg);
    background-size: 460px;
    margin: 0 auto;
}


iframe[Attributes Style] {
    border-top-width: 0px;
    border-right-width: 0px;
    border-bottom-width: 0px;
    border-left-width: 0px;
}
iframe {
    border-width: 2px;
    border-style: inset;
    border-color: initial;
    border-image: initial;
}
.platform-preview {
    position: absolute;
    /*right: 0;*/
    text-align: center;
    /*right: 20px;*/
    z-index: 1;
    background-color: white;
}

#demo-ios{
  width: 320px;
    height: 560px;  
}
            </style> 
 <?php $this->head() ?>
 
    </head>
    <body  class="<?= \dmstr\helpers\AdminLteHelper::skinClass() ?>" style="font-family: 'Ubuntu', sans-serif;" ng-app="mainApp" ng-controller="Controller">
        
        
    <?php $this->beginBody() ?>
    <div class="wrapper">

       

        <?= $this->render(
            'contentsms.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
       
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
