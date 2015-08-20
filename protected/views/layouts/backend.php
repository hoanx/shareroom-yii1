<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>


    <?php
    $baseUrl = Yii::app()->baseUrl;
    $clientScript = Yii::app()->getClientScript();

    //CSS
    $clientScript->registerCssFile($baseUrl . '/css/bootstrap.css');
    $clientScript->registerCssFile($baseUrl . '/css/font-awesome.min.css');
    $clientScript->registerCssFile($baseUrl . '/css/backend.css');

    //JS
    $clientScript->registerScriptFile($baseUrl . '/js/jquery-1.10.2.min.js');
    $clientScript->registerScriptFile($baseUrl . '/js/bootstrap.min.js');
    $clientScript->registerScriptFile('https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places');


    ?>
</head>
<body>
<header class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="navbar-header pull-left">
        <?php
        $image = CHtml::image(Yii::app()->baseUrl . '/images/logo.png', 'Logo', array('height' => 40));
        echo CHtml::link($image, array('default/index'), array('id' => 'logo', 'class' => 'navbar-brand'));
        ?>
    </div>
    <div class="navbar-header notify-row pull-right">
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope"></i>
                    <?php
                    //$countContact = UserThread::getCountContactNew();
                    $countContact = 10;
                    if (!empty($countContact)) :
                        ?>
                        <span class="badge bg-warning">
        				            <?php echo $countContact; ?>
    				            </span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user"></i>
                    <?php echo Yii::app()->getModule($this->module->id)->user->getState('name') ?>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><?php echo CHtml::link('<i class="fa fa-cog"></i> ' . Yii::t('admin', 'Thiết lập'), array('default/profile')) ?></li>
                    <li role="presentation" class="divider"></li>
                    <li><?php echo CHtml::link('<i class="fa fa-sign-out"></i>  ' . Yii::t('admin', 'Đăng xuất'), array('default/logout')) ?></li>
                </ul>
            </li>
        </ul>
    </div>
</header>
<div class="main-container">
    <div id="sidebar">
        <ul class="sidebar-menu">
            <li class="<?php Common::checkActive('default') ?>">
                <?php echo CHtml::link('<i class="fa fa-dashboard"></i>' . Yii::t('admin', 'Dashboard'), array('default/index'), array('class' => 'sidebar-item')) ?>
            </li>

            <li class="<?php Common::checkActive(array('manager')) ?>">
                <?php echo CHtml::link('<i class="fa fa-briefcase"></i>' . Yii::t('admin', 'Administrator') . '<span class="arrow"></span>', 'javascript:void(0)', array('class' => 'sidebar-item')) ?>
                <ul class="nav-custom">
                    <li><?php echo CHtml::link('<i class="fa fa-list-ul"></i>' . Yii::t('admin', 'Danh sách'), array('manager/index')) ?></li>
                    <li><?php echo CHtml::link('<i class="fa fa-plus"></i>' . Yii::t('admin', 'Thêm mới'), array('manager/create')) ?></li>
                </ul>
            </li>

            <li class="<?php Common::checkActive(array('user')) ?>">
                <?php echo CHtml::link('<i class="fa fa-user"></i>' . Yii::t('admin', 'Thành viên') . '<span class="arrow"></span>', 'javascript:void(0)', array('class' => 'sidebar-item')) ?>
                <ul class="nav-custom">
                    <li><?php echo CHtml::link('<i class="fa fa-list-ul"></i>' . Yii::t('admin', 'Danh sách'), array('user/index')) ?></li>
                    <li><?php echo CHtml::link('<i class="fa fa-plus"></i>' . Yii::t('admin', 'Thêm mới'), array('user/create')) ?></li>
                </ul>
            </li>

            <li class="<?php Common::checkActive(array('room')) ?>">
                <?php echo CHtml::link('<i class="fa fa-home"></i>' . Yii::t('admin', 'Phòng cho thuê') . '<span class="arrow"></span>', 'javascript:void(0)', array('class' => 'sidebar-item')) ?>
                <ul class="nav-custom">
                    <li><?php echo CHtml::link('<i class="fa fa-list-ul"></i>' . Yii::t('admin', 'Danh sách'), array('room/index')) ?></li>
                    <li><?php echo CHtml::link('<i class="fa fa-plus"></i>' . Yii::t('admin', 'Thêm mới'), array('room/create')) ?></li>
                </ul>
            </li>
            <li class="<?php Common::checkActive('booking') ?>">
                <?php echo CHtml::link('<i class="fa fa-money"></i>' . Yii::t('admin', 'Đặt phòng') . '<span class="arrow"></span>', 'javascript:void(0)', array('class' => 'sidebar-item')) ?>
                <ul class="nav-custom">
                    <li><?php echo CHtml::link('<i class="fa fa-list-ul"></i>' . Yii::t('admin', 'Danh sách'), array('booking/index')) ?></li>
                    <li><?php echo CHtml::link('<i class="fa fa-plus"></i>' . Yii::t('admin', 'Thêm mới'), array('booking/create')) ?></li>
                </ul>
            </li>

        </ul>
    </div>
    <div id="main-content">
        <h1 id="page-title"><?php echo $this->pageTitle ?></h1>
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
    $(document).ready(function () {
        jQuery('.sidebar-item').click(function () {
            var check = jQuery(this).parent().find("ul").hasClass('open');
            jQuery('.sidebar-menu .nav-custom').removeClass('open');
            jQuery('.sidebar-menu .nav-custom').slideUp();
            jQuery('.sidebar-menu .arrow').removeClass('open');

            if (check) {
                jQuery(this).parent().find("ul").removeClass('open');
                jQuery(this).parent().find("ul").slideUp();
                jQuery(this).find(".arrow").removeClass('open');
            } else {
                jQuery(this).parent().find("ul").addClass('open');
                jQuery(this).parent().find("ul").slideDown();
                jQuery(this).find(".arrow").addClass('open');
            }

        });
    });
</script>
</body>
</html>
