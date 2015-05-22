<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

?>

<?php
$loginFacebookUrl = $this->loginFacebookUrl;
$loginGplusUrl = $this->loginGplusUrl;
?>
<div id="signup-form">
    <h2><?php echo $this->pageTitle ?></h2>
    <div class="line-gradient">&nbsp;</div>
    <div class="login-container">
        <div class="social-buttons">
            <?php echo CHtml::link('<i class="fa fa-facebook"></i>  ' . Yii::t('app', 'Đăng ký bằng Facebook'), $loginFacebookUrl, array(
                'class' => 'btn btn-block btn-social btn-md btn-facebook btn-social-custom'
            )) ?>
            <?php echo CHtml::link('<i class="fa fa-google-plus"></i>  ' . Yii::t('app', 'Đăng ký bằng Google'), $loginGplusUrl, array(
                'class' => 'btn btn-block btn-social btn-md btn-google btn-social-custom'
            )) ?>
        </div>
        <div class="signup-or-separator">
            <h6 class="text signup-or-separator--text"><?php echo(Yii::t('app', 'Hoặc')) ?></h6>
            <hr>
        </div>

        <?php $form=$this->beginWidget('CActiveForm', array(
            'action' => $this->createUrl(Yii::app()->controller->id. '/' . Yii::app()->controller->action->id, $_GET).'#signup-form',
            'id'=>'signup_frm',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>

        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-user fa-fw"></i>
                <?php echo $form->textField($usersModel,'first_name', array(
                    'class'=>'form-control',
                    'placeholder' => $usersModel->getAttributeLabel('first_name'),
                    'autofocus' => 'autofocus'
                )); ?>
            </div>
            <?php echo $form->error($usersModel,'first_name', array('class'=>'help-block error-login')); ?>
        </div>
        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-user fa-fw"></i>
                <?php echo $form->textField($usersModel,'last_name', array(
                    'class'=>'form-control',
                    'placeholder' => $usersModel->getAttributeLabel('last_name'),
                    'autofocus' => 'autofocus'
                )); ?>
            </div>
            <?php echo $form->error($usersModel,'last_name', array('class'=>'help-block error-login')); ?>
        </div>
        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-at fa-fw"></i>
                <?php echo $form->textField($usersModel,'email', array(
                    'class'=>'form-control',
                    'placeholder' => $usersModel->getAttributeLabel('email'),
                    'autofocus' => 'autofocus'
                )); ?>
            </div>
            <?php echo $form->error($usersModel,'email', array('class'=>'help-block error-login')); ?>
        </div>
        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-key fa-fw"></i>
                <?php echo $form->passwordField($usersModel,'password', array(
                    'class'=>'form-control',
                    'placeholder' => $usersModel->getAttributeLabel('password'),
                    'autofocus' => 'autofocus'
                )); ?>
            </div>
            <?php echo $form->error($usersModel,'password', array('class'=>'help-block error-login')); ?>
        </div>
        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-key fa-fw"></i>
                <?php echo $form->passwordField($usersModel,'re_password', array(
                    'class'=>'form-control',
                    'placeholder' => $usersModel->getAttributeLabel('re_password'),
                    'autofocus' => 'autofocus'
                )); ?>
            </div>
            <?php echo $form->error($usersModel,'re_password', array('class'=>'help-block error-login')); ?>
        </div>

        <?php /*
    <div class="form-group">
        <div class="inner-addon left-addon">
            <i class="fa fa-user fa-fw"></i>
            <input type="text" class="form-control" placeholder="First name">
        </div>
    </div>
    <div class="form-group">
        <div class="inner-addon left-addon">
            <i class="fa fa-user fa-fw"></i>
            <input type="text" class="form-control" placeholder="Last name">
        </div>
    </div>

    <div class="form-group">
        <div class="inner-addon left-addon">
            <i class="fa fa-at fa-fw"></i>
            <input type="text" class="form-control" placeholder="Email">
        </div>
    </div>

    <div class="form-group">
        <div class="inner-addon left-addon">
            <i class="fa fa-key fa-fw"></i>
            <input type="text" class="form-control" placeholder="Password">
        </div>
    </div>

    <div class="form-group">
        <div class="inner-addon left-addon">
            <i class="fa fa-key fa-fw"></i>
            <input type="text" class="form-control" placeholder="Re-password">
        </div>
    </div>
 */ ?>

        <div class="actions">
            <?php echo CHtml::submitButton(Yii::t("app", "Đăng ký"), array('class'=>'btn btn-success btn-block btn-submit')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>

</div>
