<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LandingAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/landing/vendor/bootstrap/css/bootstrap.min.css',
        'css/landing/vendor/font-awesome/css/font-awesome.min.css',
        'css/landing/vendor/simple-line-icons/css/simple-line-icons.css',
        'css/landing/css/landing-page.min.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
       // 'yii\bootstrap\BootstrapAsset',
    ];
}
