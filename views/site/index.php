<?php

/* @var $this yii\web\View */

/* @var $types */

use app\assets\AppAsset;

AppAsset::addScript($this, '/js/jquery-ui.js');
AppAsset::addScript($this, '/js/search_autocomplete.js');
AppAsset::register($this);


$this->title = 'News Article Clustering';
$this->params['breadcrumbs'][] = $this->title;

?>
<link rel="stylesheet" href="/css/jquery-ui.css">

<!-- scrollToTop -->
<!-- ================ -->
<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>

<!-- page wrapper start -->
<!-- ================ -->
<div class="page-wrapper">
    <!-- background image -->
    <div class="fullscreen-bg"
         style="background: url('/img/dbs-bb.jpg');
         background-repeat:no-repeat;
         background-size:100% 100%;"></div>

    <!-- banner start -->
    <!-- ================ -->
    <div class="dark-translucent-bg">
        <div class="container">
            <div class="row justify-content-lg-center pv-45">
                <div class="col-lg-8 text-center pv-20" style="padding-top: 180px">
                    <div class="object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100">
                        <!-- logo -->
                        <div id="logo" class="logo text-center">
                            <a href="/" style="width: 150px; display: flex; margin: auto"><img src="/img/DBS logo.png" style="height: 50px; width: 150px" alt="The Project"></a>
                        </div>
                        <p class="small"></p>
                        <!-- name-and-slogan -->
                        <h1 class="page-title text-center">News Article Clustering</h1>
                        <div class="separator"></div>
                        <ul class="list-inline mb-20 text-center" style="padding-top: 20px">
                            <!-- section start -->
                            <!-- ================ -->
                            <div class="section">
                                <div class="container-fluid">
                                    <!-- filters start -->
                                    <div class="sorting-filters text-center mb-20 d-flex justify-content-center">
                                        <form class="form-inline" action="/site/result" id="submit-form" role="form"
                                              method="post">
                                            <input type="hidden" id='_csrf' name='_csrf'
                                                   value="<?= Yii::$app->request->csrfToken ?>">
                                            <div class="form-group">
                                                <label>Company name</label>
                                                <input id="tags" type="text" name='c_name' required class="form-control"
                                                       placeholder="Search">
                                            </div>
                                            <div class="form-group ml-1">
                                                <label>Type</label>
                                                <select class="form-control" name='t_name' required>
                                                    <?php
                                                    $is_first = true;
                                                    foreach ($types as $key => $name) {
                                                        echo("<option>");
                                                        echo($name);
                                                        echo("</option>");
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group  ml-1">
                                                <label>Day</label>
                                                <select class="form-control" name='day' required>
                                                    <option value="" disabled selected></option>
                                                </select>
                                            </div>

                                            <div class="form-group ml-1">
                                                <button type="submit" class="btn btn-default">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- filters end -->
                                </div>
                            </div>
                            <!-- section end -->
                        </ul>
                        <!-- countdown end -->
                        <ul class="social-links circle animated-effect-1 text-center">
                            <li class="facebook"><a target="_blank" href="http://www.facebook.com"><i
                                            class="fa fa-facebook"></i></a></li>
                            <li class="twitter"><a target="_blank" href="http://www.twitter.com"><i
                                            class="fa fa-twitter"></i></a>
                            </li>
                            <li class="googleplus"><a target="_blank" href="http://plus.google.com"><i
                                            class="fa fa-google-plus"></i></a></li>
                            <li class="linkedin"><a target="_blank" href="http://www.linkedin.com"><i
                                            class="fa fa-linkedin"></i></a></li>
                            <li class="xing"><a target="_blank" href="http://www.xing.com"><i
                                            class="fa fa-xing"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner end -->
</div>
<!-- page-wrapper end -->