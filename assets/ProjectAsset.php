<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author joddiy <joddiy@qq.com>
 * @since 2.0
 */
class ProjectAsset extends AssetBundle
{

    public $js = [
        '/soc/project/plugins/popper.min.js',
        '/soc/project/bootstrap/js/bootstrap.min.js',
        '/soc/project/plugins/modernizr.js',
//        '/project/plugins/magnific-popup/jquery.magnific-popup.min.js',
        '/soc/project/plugins/waypoints/jquery.waypoints.min.js',
//        '/project/plugins/waypoints/sticky.min.js',
//        '/project/plugins/jquery.countTo.js',
//        '/project/plugins/jquery.parallax-1.1.3.js',
//        '/project/plugins/jquery.validate.js',
//        '/project/plugins/owlcarousel2/owl.carousel.min.js',
//        '/project/plugins/jquery.countdown/js/jquery.plugin.js',
//        '/project/plugins/jquery.countdown/js/jquery.countdown.js',
//        '/project/js/coming.soon.config.js',
        '/soc/project/js/template.js',
        '/soc/project/js/custom.js',
        '/soc/js/common.js'
    ];

    public $css = [
        'http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic',
        'http://fonts.googleapis.com/css?family=Raleway:700,400,300',
        'http://fonts.googleapis.com/css?family=Pacifico',
        'http://fonts.googleapis.com/css?family=PT+Serif',
        '/soc/project/bootstrap/css/bootstrap.css',
        '/soc/project/fonts/font-awesome/css/font-awesome.css',
        '/soc/project/fonts/fontello/css/fontello.css',
//        '/project/plugins/magnific-popup/magnific-popup.css',
        '/soc/project/css/animations.css',
//        '/project/plugins/owlcarousel2/assets/owl.carousel.min.css',
//        '/project/plugins/owlcarousel2/assets/owl.theme.default.min.css',
//        '/project/plugins/hover/hover-min.css',
//        '/project/plugins/jquery.countdown/css/jquery.countdown.css',
        '/soc/project/css/style.css',
        '/soc/project/css/typography-default.css',
        '/soc/project/css/skins/light_blue.css',
//        '/project/css/custom.css',
    ];

}
