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
    $clientScript->registerScriptFile('https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places');
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
            <img src="<?php echo $baseUrl ?>/images/logo.png" style="height: 100%;width: auto" alt="Logo">
        </a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse" role="navigation">
        <ul class="nav navbar-nav navbar-right">
            <?php if (Yii::app()->user->isGuest) : ?>
                <li><?php echo CHtml::link(Yii::t('app', 'Đăng ký'), array('site/signup')) ?></li>
                <li><?php echo CHtml::link(Yii::t('app', 'Đăng nhập'), array('site/signin')) ?></li>
                <li><?php echo CHtml::link(Yii::t('app', 'Đăng tin cho thuê'), array('site/signin'), array('class' => 'btn btn-primary')) ?></li>
            <?php else : ?>
                <li>
                    <a href="#" class="dropdown-toggle"
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
                <li>
                    <?php echo CHtml::link('<i class="fa fa-envelope-o"></i>', array('message/inbox')) ?>
                    <?php echo Messages::getNotificationMail(Yii::app()->user->id) ?>
                </li>
                <li><?php echo CHtml::link(Yii::t('app', 'Đăng tin cho thuê'), array('rooms/new'), array('class' => 'btn btn-primary')) ?></li>
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
            <img src="<?php echo $baseUrl ?>/images/slides/dalat1.jpg"
                 data-thumb="<?php echo $baseUrl ?>/images/slides/dalat1.jpg" alt=""/>
            <img src="<?php echo $baseUrl ?>/images/slides/phanthiet_1408967046.jpg"
                 data-thumb="<?php echo $baseUrl ?>/images/slides/phanthiet_1408967046.jpg" alt="" data-transition="slideInLeft"/>
            <img src="<?php echo $baseUrl ?>/images/slides/phuquoc1_1408966845.jpg"
                 data-thumb="<?php echo $baseUrl ?>/images/slides/phuquoc1_1408966845.jpg" alt=""/>
            <img src="<?php echo $baseUrl ?>/images/slides/SaiGon3.jpg"
                 data-thumb="<?php echo $baseUrl ?>/images/slides/SaiGon3.jpg" alt=""/>
        </div>
        <div class="box-search">
            <h2 class="slider-caption hidden-xs"><?php echo(Yii::t('app', 'Đặt phòng du lịch với giá tốt nhất')) ?></h2>
            <div class="search-container">
                <div class="container">
                    <?php echo $this->renderPartial('//layouts/_form_search', array());?>
                </div>
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

         initialize();

         jQuery('#form-search').on("keyup keypress", function(e) {
        	  var code = e.keyCode || e.which; 
        	  if (code  == 13) {               
        	    e.preventDefault();
        	    return false;
        	  }
	    });

         jQuery('#search-button').on("click", function(e) {
    	    e.preventDefault();
            var address = document.getElementById('place-desc').value;
            var geocodersearch = new google.maps.Geocoder();
            geocodersearch.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                	var latitude = results[0].geometry.location.lat();
                	var longitude = results[0].geometry.location.lng();
                    document.getElementById('place-lat').value =  latitude;
                    document.getElementById('place-long').value =  longitude;
                    jQuery('#form-search').submit();
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
            	    return false;
                }
            });
	    });
         
         var autocompleteSearch;
         
         function initialize() {
        	    autocompleteSearch = new google.maps.places.Autocomplete((document.getElementById('place-desc')),{ types: ['geocode'] });
        	    google.maps.event.addListener(autocompleteSearch, 'place_changed', searchPlaceChanged);
    	}

         function searchPlaceChanged() {
        		var place = autocompleteSearch.getPlace();
        		if (place.geometry) {
        			document.getElementById('place-lat').value =  place.geometry.location.lat();
        		    document.getElementById('place-long').value =  place.geometry.location.lng();
        		}
    	}
    });
</script>
<script lang="javascript">
(function() {var _h1= document.getElementsByTagName('title')[0] || false;
var product_name = ''; if(_h1){product_name= _h1.textContent || _h1.innerText;}var ga = document.createElement('script'); ga.type = 'text/javascript';
ga.src = '//live.vnpgroup.net/js/web_client_box.php?hash=6b2fc79afc4ff04101b4b26a07f0b5ba&data=eyJoYXNoIjoiODkzNDg2ODhlYTQyMGRhYzAyMTcxZjEzNDUyMTYzMWEiLCJzc29faWQiOjcwMzI2OX0-&pname='+product_name;
var s = document.getElementsByTagName('script');s[0].parentNode.insertBefore(ga, s[0]);})();
</script><noscript><a href="http://www.vatgia.com" title="vatgia.com" target="_blank">Tài trợ bởi vatgia.com</a></noscript><noscript><a href="http://vchat.vn" title="vchat.vn" target="_blank">Phát triển bởi vchat.vn</a></noscript>	
</body>
</html>
