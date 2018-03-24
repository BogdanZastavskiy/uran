<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\assets;
use yii\web\AssetBundle;
/**
 * Description of FilterAsset
 *
 * @author user
 */
class FilterAsset extends AssetBundle {
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $js = [
        'js/filter.js'
    ];
    
    public $depends = [
        AppAsset::class
    ];
}
