<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    
    <?php $this->head() ?>
    <style type="text/css">
    	.login-logo{
    		font-family: 'Gloria Hallelujah', cursive;
    	}
    </style>
    <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">

</head>
<body class="login-page" style="background: url('../img/reports.jpg');background-size: cover">
	

<?php $this->beginBody() ?>
<div style="background-color: rgba(0,0,0,.5);position: absolute;width: 100%;height: 100%;">

    <?= $content ?>

<?php $this->endBody() ?>
</div>
</body>
</html>
<?php $this->endPage() ?>

