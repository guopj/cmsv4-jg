<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = ['position'=>View::POS_HEAD];
    public $css = [
        'static/dist/css/AdminLTE.min.css',
        'static/dist/css/skins/_all-skins.min.css',
		'static/dist/css/font-awesome.min.css',
        //'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',			//字体文件
    ];
    public $js = [
        'static/common/js/jquery-ui.min.js',
        'static/bootstrap/js/bootstrap.min.js',
        'static/common/js/jquery.slimscroll.min.js',
        'static/dist/js/app.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
