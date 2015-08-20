<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>


    <?php
    $baseUrl = Yii::app()->baseUrl;
    $clientScript = Yii::app()->getClientScript();

    //CSS
    $clientScript->registerCssFile($baseUrl . '/css/bootstrap.css');
    $clientScript->registerCssFile($baseUrl . '/css/font-awesome.min.css');
    $clientScript->registerCssFile($baseUrl . '/css/login.css');

    //JS
    $clientScript->registerScriptFile($baseUrl . '/js/jquery-1.10.2.min.js');
    $clientScript->registerScriptFile($baseUrl . '/js/bootstrap.min.js');
    ?>
</head>
<body>
<div class="container">
    <?php if (Yii::app()->user->hasFlash('success')): ?>
        <div class="alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php elseif (Yii::app()->user->hasFlash('error')): ?>
        <div class="alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
    <?php endif; ?>
    <?php echo $content; ?>
</div>
<!-- JS  -->
<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 10]>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/html5shiv.js'?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/jquery.placeholder.min.js'?>"></script>
<script type="text/javascript">
    $(function () {
        $('input, textarea').placeholder();
    });
</script>
<![endif]-->

<script type="text/javascript">
    $(document).ready(function () {
        jQuery.noConflict();
    });
</script>
</body>
</html>
