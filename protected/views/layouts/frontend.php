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
<header class="navbar navbar-inverse navbar-custom">
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
                <!--<li><a href="#signup-modal" data-toggle="modal" data-target="#signup-modal"><?php /*echo Yii::t('app', 'Sign Up') */?></a></li>
                <li><a href="#signup-modal" data-toggle="modal" data-target="#signin-modal"><?php /*echo Yii::t('app', 'Sign In') */?></a></li>-->

                <li><?php echo CHtml::link(Yii::t('app', 'Đăng ký'), array('site/signup')) ?></a></li>
                <li><?php echo CHtml::link(Yii::t('app', 'Đăng nhập'), array('site/signin')) ?></a></li>
            <?php else : ?>
                <li>
                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown"><?php echo Yii::app()->getModule('user')->user->username ?></a>
                    <ul class="dropdown-menu">
                        <li><?php echo CHtml::link('<i class="fa fa-user"></i>  ' . Yii::t('app', 'Bảng hoạt động'), array('profile/index')) ?></li>
                        <li><?php echo CHtml::link('<i class="fa fa-user"></i>  ' . Yii::t('app', 'Thông tin cá nhân'), array('profile/index')) ?></li>
                        <li><?php echo CHtml::link('<i class="fa fa-cog"></i>  ' . Yii::t('app', 'Đổi mật khẩu'), array('profile/newpass')) ?></li>
                        <li><?php echo CHtml::link('<i class="fa fa-envelope"></i> ' . Yii::t('app', 'Hộp thư'), array('message/index')) ?></li>
                        <li><?php echo CHtml::link('<i class="fa fa-sign-out"></i> ' . Yii::t('app', 'Đăng xuất'), array('default/logout')) ?></li>
                    </ul>
                </li>
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
            <img src="<?php echo $baseUrl ?>/images/slides/toystory.jpg"
                 data-thumb="<?php echo $baseUrl ?>/images/slides/toystory.jpg" alt=""/>
            <img src="<?php echo $baseUrl ?>/images/slides/walle.jpg"
                 data-thumb="<?php echo $baseUrl ?>/images/slides/walle.jpg" alt="" data-transition="slideInLeft"/>
            <img src="<?php echo $baseUrl ?>/images/slides/nemo.jpg"
                 data-thumb="<?php echo $baseUrl ?>/images/slides/nemo.jpg" alt=""/>
            <img src="<?php echo $baseUrl ?>/images/slides/up.jpg"
                 data-thumb="<?php echo $baseUrl ?>/images/slides/up.jpg" alt=""/>
        </div>
    </div>
<?php else : ?>
    <div class="image-banner">
        <img src="<?php echo $baseUrl ?>/images/banner.jpg" class="img-responsive"/>
    </div>
<?php endif; ?>
<div class="container">
    <!--<div class="head-line">
        <h2><?php /*echo $this->pageTitle */?></h2>
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
</div>

<footer>
    <div class="container">
        <div class="pull-right">
            <a href="#">
                <img src="<?php echo $baseUrl ?>/images/dangkybocongthuong.jpg">
            </a>
        </div>
        <div>
            <ul>
                <li><a href="#"><?php echo(Yii::t('app', 'Giới thiệu shareroom')) ?></a></li>
                <li><a href="#"><?php echo(Yii::t('app', 'Về chúng tôi')) ?></a></li>
                <li><a href="#"><?php echo(Yii::t('app', 'Chính sách riêng tư')) ?></a></li>
                <li><a href="#"><?php echo(Yii::t('app', 'Điều kiện & điều khoản')) ?></a></li>
            </ul>
        </div>
    </div>
</footer>

<?php if(Yii::app()->user->isGuest) : ?>
<div class="modal fade signin-modal" id="signin-modal" tabindex="-1" role="dialog" aria-labelledby="signin-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-vertical-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form">
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'login-form',
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                            'validateOnSubmit'=>true,
                        ),
                    )); ?>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <?php echo $form->textField($this->loginFormModel,'username', array(
                                'class'=>'form-control',
                                'placeholder' => $this->loginFormModel->getAttributeLabel('username'),
                                'autofocus' => 'autofocus'
                            )); ?>
                        </div>
                        <?php echo $form->error($this->loginFormModel,'username', array('class'=>'help-block error-login')); ?>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <?php echo $form->passwordField($this->loginFormModel,'password', array(
                                'class'=>'form-control',
                                'placeholder' => $this->loginFormModel->getAttributeLabel('password'),
                                'autofocus' => 'autofocus'
                            )); ?>
                        </div>
                        <?php echo $form->error($this->loginFormModel,'password', array('class'=>'help-block error-login')); ?>
                    </div>



                    <div class="row rememberMe">
                        <?php echo $form->checkBox($this->loginFormModel,'rememberMe'); ?>
                        <?php echo $form->label($this->loginFormModel,'rememberMe'); ?>
                        <?php echo $form->error($this->loginFormModel,'rememberMe'); ?>
                    </div>

                    <div class="actions">
                        <?php echo CHtml::submitButton(Yii::t("app", "Login"), array('class'=>'btn btn-success btn-block btn-submit')); ?>
                    </div>

                    <?php $this->endWidget(); ?>
                </div><!-- form -->
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade signup-modal" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="signup-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-vertical-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="social-buttons">
                    <a class="btn btn-block btn-social btn-md btn-facebook btn-social-custom"
                       href="javascript:void(0)">
                        <i class="fa fa-facebook"></i>
                        Sign up with Facebook
                    </a>
                </div>
                <div class="signup-or-separator">
                    <h6 class="text signup-or-separator--text">or</h6>
                    <hr>
                </div>
                <!-- Form Sign in-->
                <form>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="First name">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Last name">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-at"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-key"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-key"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Re-password">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-danger btn-block">Register</button>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                Already a member? <a href="javascript:void(0)" data-dismiss="modal" data-toggle="modal" data-target="#signin-modal">Login here</a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

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
            controlNav: false
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
