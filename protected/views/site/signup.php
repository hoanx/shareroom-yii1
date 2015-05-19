<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

?>
<h2><?php echo $this->pageTitle ?></h2>
<div class="line-gradient">&nbsp;</div>
<div class="login-container">
    <div class="social-buttons">
        <?php echo CHtml::link('<i class="fa fa-facebook"></i>  ' . Yii::t('app', 'Đăng ký bằng Facebook'), 'javascript:void(0)', array(
            'class' => 'btn btn-block btn-social btn-md btn-facebook btn-social-custom'
        )) ?>
        <?php echo CHtml::link('<i class="fa fa-google-plus"></i>  ' . Yii::t('app', 'Đăng ký bằng Google'), 'javascript:void(0)', array(
            'class' => 'btn btn-block btn-social btn-md btn-google btn-social-custom'
        )) ?>
    </div>
    <div class="signup-or-separator">
        <h6 class="text signup-or-separator--text"><?php echo(Yii::t('app', 'Hoặc')) ?></h6>
        <hr>
    </div>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

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

    <div class="actions">
        <?php echo CHtml::submitButton(Yii::t("app", "Đăng ký"), array('class'=>'btn btn-success btn-block btn-submit')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
