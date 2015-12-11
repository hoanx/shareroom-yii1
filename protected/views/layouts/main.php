<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="language" content="vi">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <meta name="title" content="<?php echo $this->title ?> - Shareroom">
    <meta name="description" content="<?php echo $this->descriptions ?> - Shareroom">
    <meta name="keywords" content="Shareroom, <?php echo $this->keywords ?>">
    <meta name="robots" content="noodp,index,follow">
    <meta name="author" content="shareroom.vn">

    <meta property="og:title" content="<?php echo CHtml::encode($this->pageTitle); ?>" />
    <meta property="og:description"
          content="<?php echo $this->descriptions ?> - Shareroom, shareroom" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo Yii::app()->getRequest()->getUrl()  ?>" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="fb:app_id" content="<?php echo Yii::app()->facebook->appId ?>">


    <?php
    $baseUrl = Yii::app()->baseUrl;
    $clientScript = Yii::app()->getClientScript();
    //CSS
    $clientScript->registerCssFile($baseUrl . '/css/bootstrap.css');
    $clientScript->registerCssFile($baseUrl . '/css/font-awesome.min.css');
    $clientScript->registerCssFile($baseUrl . '/css/bootstrap-social.css');
    $clientScript->registerCssFile($baseUrl . '/css/bootstrap-switch.min.css');
    $clientScript->registerCssFile($baseUrl . '/css/default/default.css');
    $clientScript->registerCssFile($baseUrl . '/css/nivo-slider.css');
    $clientScript->registerCssFile($baseUrl . '/css/frontend.css');
    $clientScript->registerCssFile($baseUrl . '/css/style-room.css');
    $clientScript->registerCssFile($baseUrl . '/css/responsive.css');
    $clientScript->registerCssFile($baseUrl . '/css/normalize.css');
    $clientScript->registerCssFile($baseUrl . '/css/ion.rangeSlider.css');
    $clientScript->registerCssFile($baseUrl . '/css/ion.rangeSlider.skinHTML5.css');
    //JS
    $clientScript->registerScriptFile($baseUrl . '/js/jquery-1.10.2.min.js');
    $clientScript->registerScriptFile($baseUrl . '/js/jquery.form.min.js');
    $clientScript->registerScriptFile($baseUrl . '/js/jquery.nivo.slider.js');
    $clientScript->registerScriptFile($baseUrl . '/js/ion.rangeSlider.js');
    $clientScript->registerScriptFile($baseUrl . '/js/bootstrap.min.js');
    $clientScript->registerScriptFile($baseUrl . '/js/bootstrap-switch.min.js');
    $clientScript->registerScriptFile('https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places');

    $clientScript->registerScriptFile($baseUrl . '/js/geocodingapi.js');

    ?>
</head>
<body>
<header class="navbar navbar-main">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle pull-right" data-toggle="collapse"
                    data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">
                <img src="<?php echo $baseUrl ?>/images/logo.png" style="height: 100%;width: auto" alt="Logo">
            </a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse" role="navigation">
            <ul class="nav navbar-nav navbar-right">
                <?php if (Yii::app()->user->isGuest) : ?>
                    <li><?php echo CHtml::link(Yii::t('app', 'Đăng ký'), array('site/signup')) ?></li>
                    <li><?php echo CHtml::link(Yii::t('app', 'Đăng nhập'), array('site/signin')) ?></li>
                    <li><?php echo CHtml::link(Yii::t('app', 'Đăng tin cho thuê'), array('site/signin'), array('class'=>'btn btn-primary')) ?></li>
                <?php else : ?>
                    <li class="right-line">
                        <a href="#" class="dropdown-toggle menu-link"
                           data-toggle="dropdown"><?php echo Yii::t('app', 'Xin Chào'). ', ' . Yii::app()->user->first_name ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><?php echo CHtml::link('<i class="fa fa-user"></i>  ' . Yii::t('app', 'Bảng hoạt động'), array('profile/dashboard')) ?></li>
                            <li><?php echo CHtml::link('<i class="fa fa-user"></i>  ' . Yii::t('app', 'Thông tin cá nhân'), array('profile/edit')) ?></li>
                            <li><?php echo CHtml::link('<i class="fa fa-cog"></i>  ' . Yii::t('app', 'Thiết lập'), array('profile/changepass')) ?></li>
                            <li><?php echo CHtml::link('<i class="fa fa-heart"></i> ' . Yii::t('app', 'Yêu thích'), array('profile/wishlist')) ?></li>
                            <li><?php echo CHtml::link('<i class="fa fa-envelope"></i> ' . Yii::t('app', 'Hộp thư'), array('message/inbox')) ?></li>
                            <li><?php echo CHtml::link('<i class="fa fa-sign-out"></i> ' . Yii::t('app', 'Đăng xuất'), array('site/logout')) ?></li>
                        </ul>
                    </li>
                    <li class="right-line mail-link">
                        <?php echo CHtml::link('<i class="fa fa-envelope-o"></i>', array('message/inbox'), array('class'=>'menu-link')) ?>
                        <?php echo Messages::getNotificationMail(Yii::app()->user->id) ?>
                    </li>
                    <li><?php echo CHtml::link(Yii::t('app', 'Đăng tin cho thuê'), array('rooms/new'), array('class'=>'btn btn-primary')) ?></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>
<div class="main-content">
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
<script lang="javascript">
(function() {var _h1= document.getElementsByTagName('title')[0] || false;
var product_name = ''; if(_h1){product_name= _h1.textContent || _h1.innerText;}var ga = document.createElement('script'); ga.type = 'text/javascript';
ga.src = '//live.vnpgroup.net/js/web_client_box.php?hash=6b2fc79afc4ff04101b4b26a07f0b5ba&data=eyJoYXNoIjoiODkzNDg2ODhlYTQyMGRhYzAyMTcxZjEzNDUyMTYzMWEiLCJzc29faWQiOjcwMzI2OX0-&pname='+product_name;
var s = document.getElementsByTagName('script');s[0].parentNode.insertBefore(ga, s[0]);})();
</script><noscript><a href="http://www.vatgia.com" title="vatgia.com" target="_blank">Tài trợ bởi vatgia.com</a></noscript><noscript><a href="http://vchat.vn" title="vchat.vn" target="_blank">Phát triển bởi vchat.vn</a></noscript>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-71186603-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>
