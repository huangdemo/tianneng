<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/layout.css',
        'css/banner.css',
        'css/menu.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/jquery.slidizle.js',
        'js/jquery.ssd-vertical-navigation.min.js',
        'js/modernizr.custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
