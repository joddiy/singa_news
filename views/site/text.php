<?php

/* @var $this yii\web\View */

/* @var $article \app\models\News */

use app\assets\AppAsset;

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
        <header class="header pv-20  clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <!-- header-first start -->
                        <!-- ================ -->
                        <div class="header-first clearfix">

                            <!-- logo -->
                            <div id="logo" class="logo d-flex justify-content-center justify-content-md-start">
                                <h3 class="margin-clear"><a href="/" class="logo-font link-light"><span
                                                class="text-default">SINGA</span></a></h3>
                            </div>

                            <!-- name-and-slogan -->
                            <div class="site-slogan text-center-xs">
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
                <li class="breadcrumb-item"><i class="fa fa-home pr-2"></i><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Article</li>
            </ol>
        </div>
    </div>
    <!-- main-container start -->
    <!-- ================ -->
    <section class="main-container">

        <div class="container">
            <div class="row">

                <section class="main-container padding-ver-clear">
                    <div class="container">
                        <div class="row">

                            <!-- main start -->
                            <!-- ================ -->
                            <div class="main col-lg-12">
                                <h1 class="title"><?= $article->n_title ?></h1>
                                <div class="separator-2"></div>
                                <?php
                                $is_first = true;
                                $handle = fopen(Yii::$app->params['base_dir'] . $article->n_path, "r");
                                if ($handle) {
                                    while (($line = fgets($handle)) !== false) {
                                        if ($is_first) {
                                            $is_first = !$is_first;
                                            continue;
                                        }
                                        echo "<p>{$line}</p>";
                                    }

                                    fclose($handle);
                                } else {
                                }
                                ?>
                            </div>
                            <!-- main end -->
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </section>
    <!-- main-container end -->


</div>
<!-- page-wrapper end -->
