<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="language" content="en">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>


    <?php
    $baseUrl = Yii::app()->baseUrl;
    $clientScript = Yii::app()->getClientScript();
    //CSS
    $clientScript->registerCssFile($baseUrl . '/css/bootstrap.css');
    $clientScript->registerCssFile($baseUrl . '/css/font-awesome.min.css');
    $clientScript->registerCssFile($baseUrl . '/css/bootstrap-social.css');
    $clientScript->registerCssFile($baseUrl . '/css/default/default.css');
    $clientScript->registerCssFile($baseUrl . '/css/nivo-slider.css');
    $clientScript->registerCssFile($baseUrl . '/css/frontend.css');
    $clientScript->registerCssFile($baseUrl . '/css/responsive.css');
    //JS
    $clientScript->registerScriptFile($baseUrl . '/js/jquery-1.10.2.min.js');
    $clientScript->registerScriptFile($baseUrl . '/js/jquery.nivo.slider.js');
    $clientScript->registerScriptFile($baseUrl . '/js/bootstrap.min.js');
    ?>
</head>
<body>
<header class="navbar navbar-custom">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle pull-right" data-toggle="collapse"
                data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="/" class="navbar-brand">
            <img src="<?php echo $baseUrl ?>/images/logo.png" alt="Logo">
        </a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse" role="navigation">
        <ul class="nav navbar-nav pull-right">
            <?php if (Yii::app()->user->isGuest) : ?>
                <li><?php echo CHtml::link(Yii::t('app', 'Đăng ký'), array('site/signup')) ?></li>
                <li><?php echo CHtml::link(Yii::t('app', 'Đăng nhập'), array('site/signin')) ?></li>
                <li><?php echo CHtml::link(Yii::t('app', 'Đăng tin cho thuê'), array('/'), array('class' => 'btn btn-primary')) ?></li>
            <?php else : ?>
                <li>
                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown"><?php echo Yii::t('app', 'Xin Chào'). ', ' . Yii::app()->user->first_name ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><?php echo CHtml::link('<i class="fa fa-user"></i>  ' . Yii::t('app', 'Bảng hoạt động'), array('profile/dashboard')) ?></li>
                        <li><?php echo CHtml::link('<i class="fa fa-user"></i>  ' . Yii::t('app', 'Thông tin cá nhân'), array('profile/edit')) ?></li>
                        <li><?php echo CHtml::link('<i class="fa fa-cog"></i>  ' . Yii::t('app', 'Thiết lập'), array('profile/changepass')) ?></li>
                        <li><?php echo CHtml::link('<i class="fa fa-envelope"></i> ' . Yii::t('app', 'Hộp thư'), array('message/inbox')) ?></li>
                        <li><?php echo CHtml::link('<i class="fa fa-sign-out"></i> ' . Yii::t('app', 'Đăng xuất'), array('site/logout')) ?></li>
                    </ul>
                </li>
                <li><?php echo CHtml::link('<i class="fa fa-envelope-o"></i>', array('message/inbox')) ?></li>
                <li><?php echo CHtml::link(Yii::t('app', 'Đăng tin cho thuê'), array('rooms/news'), array('class' => 'btn btn-primary')) ?></li>
            <?php endif; ?>
        </ul>
    </div>
</header>
<?php
$controller = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;
?>
<?php if ($controller == "site" && $action == "index") : ?>
    <div class="slider-wrapper theme-default">
        <div id="slider" class="nivoSlider">
            <img src="<?php echo $baseUrl ?>/images/slides/city.jpg"
                 data-thumb="<?php echo $baseUrl ?>/images/slides/city.jpg" alt=""/>
            <img src="<?php echo $baseUrl ?>/images/slides/home.jpg"
                 data-thumb="<?php echo $baseUrl ?>/images/slides/home.jpg" alt="" data-transition="slideInLeft"/>
            <img src="<?php echo $baseUrl ?>/images/slides/sleep.jpg"
                 data-thumb="<?php echo $baseUrl ?>/images/slides/sleep.jpg" alt=""/>
        </div>
        <div class="box-search">
            <div class="container">
                <h2 class="slider-caption"><?php echo(Yii::t('app', 'Đặt phòng du lịch với giá tốt nhất')) ?></h2>

                <form class="frm-search row">
                    <div class="col-sm-12 col-md-4">
                        <div class="form-group">
                            <div class="inner-addon left-addon">
                                <i class="fa fa-map-marker"></i>
                                <input type="text" class="form-control input-lg"
                                       placeholder="<?php echo(Yii::t('app', 'Điểm đến của bạn')) ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="form-group">
                            <div class="inner-addon left-addon">
                                <i class="fa fa-calendar"></i>
                                <input type="text" class="form-control input-lg"
                                       placeholder="<?= Yii::t('app', 'Nhận phòng') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="form-group">
                            <div class="inner-addon left-addon">
                                <i class="fa fa-calendar"></i>
                                <input type="text" class="form-control input-lg" placeholder="<?= Yii::t('app', 'Trả phòng') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="form-group">
                            <div class="inner-addon left-addon">
                                <i class="fa fa-users"></i>
                                <input type="text" class="form-control input-lg" placeholder="<?= Yii::t('app', 'Khách') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-2">
                        <button id="search-button" class="btn btn-primary btn-block btn-lg"
                                type="submit"><?= Yii::t('app', 'Tìm kiếm') ?></button>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="image-banner">
        <img src="<?php echo $baseUrl ?>/images/banner.jpg" class="img-responsive"/>
    </div>
<?php endif; ?>
<div class="container">
    <!--<div class="head-line">
        <h2><?php /*echo $this->pageTitle */ ?></h2>
    </div>-->
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

    <?php /* $this->widget('\YiiFacebook\Plugins\LikeButton', array(
        'href' => $baseUrl, // if omitted Facebook will use the OG meta tag
        'show_faces'=>true,
        'share' => true
    )); */
    ?>
</div>

<?php echo $this->renderPartial('//layouts/_footer', array('baseUrl' => $baseUrl)); ?>
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
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#slider').nivoSlider({
            controlNav: false,
            directionNav: false
        });

        /*window.onscroll = function (oEvent) {
         var pos = jQuery('body').scrollTop();
         if (pos > 400) {
         jQuery('.navbar').addClass('navbar-custom');
         } else {
         jQuery('.navbar').removeClass('navbar-custom');
         }
         }*/
    });
</script>
</body>
</html>
