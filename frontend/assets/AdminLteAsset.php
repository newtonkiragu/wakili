<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AdminLteAsset extends AssetBundle
{
  
    public $sourcePath = '@webroot/upgrade/dist';
    public $css = [
        'css/adminlte.min.css',
        'css/app.css',
        'plugins/font-awesome/css/font-awesome.min.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700',
    ];
    public $js = [
        'plugins/jquery/jquery.min.js',
        'plugins/bootstrap/js/bootstrap.bundle.min.js',
        'js/adminlte.min.js',
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $depends = [
//        'rmrevin\yii\fontawesome\AssetBundle',
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
    ];

    /**
     * @var string|bool Choose skin color, eg. `'skin-blue'` or set `false` to disable skin loading
     * @see https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html#layout
     */
    public $skin = '_all-skins';
}
