<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

?>
<?php
//$loginUrl = Yii::app()->facebook->getLoginUrl(Yii::app()->createAbsoluteUrl('site/signup'));
$loginFacebookUrl = $this->loginFacebookUrl;
$loginGplusUrl = $this->loginGplusUrl;
?>

<div id="signin-form">
    <h2><?php echo $this->pageTitle ?></h2>
    <div class="line-gradient">&nbsp;</div>
    <div class="login-container">
        <div class="social-buttons">
            <!--<a class="btn btn-block btn-social btn-md btn-facebook btn-social-custom"
               href="javascript:void(0)">
                <i class="fa fa-facebook"></i>
                Sign in with Facebook
            </a>-->
            <?php echo CHtml::link('<i class="fa fa-facebook"></i>  ' . Yii::t('app', 'Đăng nhập bằng Facebook'), $loginFacebookUrl, array(
                'class' => 'btn btn-block btn-social btn-md btn-facebook btn-social-custom'
            )) ?>
            <?php echo CHtml::link('<i class="fa fa-google-plus"></i>  ' . Yii::t('app', 'Đăng nhập bằng Google'), $loginGplusUrl, array(
                'class' => 'btn btn-block btn-social btn-md btn-google btn-social-custom'
            )) ?>
        </div>
        <div class="signup-or-separator">
            <h6 class="text signup-or-separator--text"><?php echo(Yii::t('app', 'Hoặc')) ?></h6>
            <hr>
        </div>

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login-form',
            'action' => $this->createUrl(Yii::app()->controller->id. '/' . Yii::app()->controller->action->id, $_GET).'#signin-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>

        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-at fa-fw"></i>
                <?php echo $form->textField($model,'email', array(
                    'class'=>'form-control',
                    'placeholder' => $model->getAttributeLabel('email'),
                    'autofocus' => 'autofocus'
                )); ?>
            </div>
            <?php echo $form->error($model,'email', array('class'=>'help-block error-login')); ?>
        </div>

        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-lock fa-fw"></i>
                <?php echo $form->passwordField($model,'password', array(
                    'class'=>'form-control',
                    'placeholder' => $model->getAttributeLabel('password'),
                    'autofocus' => 'autofocus'
                )); ?>
            </div>
            <?php echo $form->error($model,'password', array('class'=>'help-block error-login')); ?>
        </div>



        <div class="rememberMe form-group">
            <?php echo $form->checkBox($model,'rememberMe'); ?>
            <?php echo $form->label($model,'rememberMe'); ?>
            <?php echo $form->error($model,'rememberMe'); ?>
        </div>

        <div class="actions">
            <?php echo CHtml::submitButton(Yii::t("app", "Đăng nhập"), array('class'=>'btn btn-success btn-block btn-submit')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>