<?php


namespace backend\assets;


use yii\web\AssetBundle;

class AppAssetSummerNote extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'summernote/summernote-bs4.min.css',
    ];
    public $js = [
        'summernote/summernote-bs4.min.js',
        'summernote/editor.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];

}