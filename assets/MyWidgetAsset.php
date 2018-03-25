<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * Description of MyWidgetAsset
 *
 * @author user
 */
class MyWidgetAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        'js/mywidget'
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $depends = [
        AppAsset::class
    ];
}
