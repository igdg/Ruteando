<?php
/**
 * Created by PhpStorm.
 * User: xenon-pb
 * Date: 27/03/2017
 * Time: 13:37
 */

namespace app\themes\nacho\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/grayscale.min.css',
        'css/font-awesome/css/font-awesome.min.css',
        'css/estilo.css'
    ];
    public $js = [
        'js/rutas.js',
        'js/grayscale.min.js',
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyAG3FzyST96Ql_7YzQ_K4gjvf60mX84sMQ&libraries=geometry',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset'
    ];
}

?>