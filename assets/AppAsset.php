<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/dataTables.bootstrap.css',
        'css/buttons.dataTables.min.css',
        'css/jquery.dataTables.min.css',
        'css/buttons.bootstrap.min.css',
    ];
    public $js = [
        // 'js/dropdown.js',
        'js/bootstrap.min.js',
        'js/jquery.dataTables.min.js',
        'js/dataTables.bootstrap.min.js',
        'js/buttons.flash.min.js',
        'js/dataTables.buttons.min.js',
        'js/jszip.min.js',
        'js/pdfmake.min.js',
        'js/vfs_fonts.js',
        'js/buttons.html5.min.js',
        'js/buttons.print.min.js',
        'js/buttons.colVis.min.js',
        'js/highcharts.js',
        'js/modules/exporting.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
