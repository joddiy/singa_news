<?php


/* @var $this yii\web\View
 * @var $articles
 * @var $c_name
 * @var $t_name
 * @var $day
 * @var $rel
 */


use app\assets\AppAsset;


AppAsset::addScript($this, "http://d3js.org/d3.v3.min.js");
AppAsset::addScript($this, "/soc/js/vis.js");
AppAsset::addCss($this, "/soc/css/vis.css");
AppAsset::register($this);


$this->title = 'News Article Clustering';
$this->params['breadcrumbs'][] = $this->title;

?>

<!-- scrollToTop -->
<!-- ================ -->
<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>

<!-- page wrapper start -->
<!-- ================ -->
<div class="page-wrapper">
    <!-- header-container start -->
    <div id="header" class="header-container">
        <!-- header start -->
        <!-- classes:  -->
        <!-- "fixed": enables fixed navigation mode (sticky menu) e.g. class="header fixed clearfix" -->
        <!-- "fixed-desktop": enables fixed navigation only for desktop devices e.g. class="header fixed fixed-desktop clearfix" -->
        <!-- "fixed-all": enables fixed navigation only for all devices desktop and mobile e.g. class="header fixed fixed-desktop clearfix" -->
        <!-- "dark": dark version of header e.g. class="header dark clearfix" -->
        <!-- "full-width": mandatory class for the full-width menu layout -->
        <!-- "centered": mandatory class for the centered logo layout -->
        <!-- ================ -->
        <header class="header pv-20 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <!-- header-first start -->
                        <!-- ================ -->
                        <div class="header-first clearfix">

                            <!-- logo -->
                            <div id="logo" class="logo">
                                <a href="/soc"><img src="/soc/img/soc_logo.jpg" style="height: 35px; width: 150px"
                                                 alt="The Project"></a>
                            </div>

                            <!-- name-and-slogan -->
                            <div style="padding-left: 20px" class="site-slogan text-center-xs">
                                News Article Clustering
                            </div>

                        </div>
                        <!-- header-first end -->
                    </div>
                    <div class="col-md-8">
                        <ul class="social-links text-md-right text-center-xs animated-effect-1 circle small clearfix">
                            <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i
                                            class="fa fa-facebook"></i></a></li>
                            <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i
                                            class="fa fa-twitter"></i></a></li>
                            <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i
                                            class="fa fa-google-plus"></i></a></li>
                            <li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i
                                            class="fa fa-linkedin"></i></a></li>
                            <li class="pinterest"><a target="_blank" href="http://www.xing.com"><i
                                            class="fa fa-xing"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- header end -->
    </div>
    <!-- header-container end -->
    <div class="breadcrumb-container">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home pr-2"></i><a href="/soc">Home</a></li>
                <li class="breadcrumb-item active">Result: [<?php echo $c_name . " , " . $t_name . " , " . $day ?>]
                </li>
            </ol>
        </div>
    </div>
    <!-- main-container start -->
    <!-- ================ -->
    <section class="main-container">

        <div class="container">
            <div class="row">

                <!-- main start -->
                <!-- ================ -->
                <div class="main col-lg-8">
                    <h1 class="title">Cluster</h1>
                    <div class="separator-2"></div>
                    <?php
                    if (empty($articles)) {
                        echo <<<EOF
<div class="row justify-content-lg-center">

    <!-- main start -->
    <!-- ================ -->
    <div class="main col-lg-12 pv-40">
      <h2 class="mt-4">Ooops! News Not Found</h2>
      <p class="lead">Please check your request. Make sure that the request info you submitted is correct. If you have any question, please inform the admin. </p>
    </div>
    <!-- main end -->

</div>
EOF;

                    } else {
                        foreach ($articles as $key => $cluster) {
                            echo <<<EOF
<div id="comments" class="comments" style="
    margin-top:  30px;">
    <h2 class="title" style="margin-bottom:  20px;"># {$key}</h2>
EOF;
                            $is_first = true;
                            foreach ($cluster as $article) {
                                $r_time = date('H:i', rand(0, 3600 * 24));
                                if ($is_first) {
//                                    $content = substr($article['n_des'], 0, 200) . " ...";
                                    echo <<<EOF
<!-- comment start -->
<div class="comment clearfix">
    <header>
        <a href="/soc/site/text?n_id={$article['n_id']}"><h4>{$article['n_title']}</h4></a>
        <div class="comment-meta">By <a href="#">admin</a> | Today, {$r_time}</div>
        <p style="line-height: 1.5em; height: 3em; overflow: hidden; ">{$article['n_des']}</p>
    </header>
<!-- comment end -->
EOF;
                                    if (count($cluster) > 1) {
                                        echo "<br/>";
                                    }
                                    $is_first = false;
                                } else {
                                    echo <<<EOF
<!-- comment start -->
<div class="comment clearfix"style="
    margin-bottom:  20px;">
    <header>
        <a href="/soc/site/text?n_id={$article['n_id']}"><h4>{$article['n_title']}</h4></a>
        <div class="comment-meta">By <a href="#">admin</a> | Today, {$r_time}</div>
    </header>
<!-- comment end -->
</div>
EOF;
                                }

                            }
                            echo "</div></div>";
                        }
                    }
                    ?>

                </div>
                <!-- main end -->

                <!-- sidebar start -->
                <!-- ================ -->
                <aside class="col-lg-4 col-xl-4 ml-xl-auto">
                    <div class="sidebar">
                        <div class="block clearfix">
                            <h3 class="title">Visualization</h3>
                            <div class="separator-2"></div>
                            <input type="hidden" id='c_name' value="<?= $c_name ?>">
                            <input type="hidden" id='t_name' value="<?= $t_name ?>">
                            <input type="hidden" id='day' value="<?= $day ?>">
                            <div style="margin-bottom: 10px">
                                <button name='rel' class="btn btn-sm twitter">all relations</button>
                                <button name='rel' class="btn btn-sm facebook">type of</button>
                                <button name='rel' class="btn btn-sm googleplus">related</button>
                                <button name='rel' class="btn btn-sm vine">located</button>
                                <button name='rel' class="btn btn-sm soundcloud">key peop</button>
                                <button name='rel' class="btn btn-sm linkedin">label</button>
                            </div>
                            <div id="svg-body" style="width:350px; height: 566px"></div>
                        </div>
                    </div>
                </aside>
                <!-- sidebar end -->
            </div>
        </div>
    </section>
    <!-- main-container end -->


</div>
<!-- page-wrapper end -->
