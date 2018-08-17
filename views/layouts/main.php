<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use yii\web\View;

AppAsset::addScript($this, "/news/project/plugins/jquery.min.js", ["position" => View::POS_HEAD]);
AppAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="<?= Yii::$app->language ?>">
<!--header-->
<!--================================-->
<?= $this->render('header') ?>
<!--================================-->
<!--End header-->
<body class=" ">
<?php $this->beginBody() ?>

<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
