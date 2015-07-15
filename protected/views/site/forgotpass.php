<div id="signin-form">
    <h2><?php echo $this->pageTitle ?></h2>
    <div class="line-gradient">&nbsp;</div>
    <div class="login-container">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'forgot-form',
            'clientOptions'=>array(
            ),
        )); ?>

        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-key fa-fw"></i>
                <?php echo $form->passwordField($user,'password', array(
                    'class'=>'form-control input-lg',
                    'placeholder' => $user->getAttributeLabel('password'),
                    'autofocus' => 'autofocus'
                )); ?>
            </div>
            <?php echo $form->error($user,'password', array('class'=>'help-block error-login')); ?>
        </div>
        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-key fa-fw"></i>
                <?php echo $form->passwordField($user,'re_password', array(
                    'class'=>'form-control input-lg',
                    'placeholder' => $user->getAttributeLabel('re_password'),
                    'autofocus' => 'autofocus'
                )); ?>
            </div>
            <?php echo $form->error($user,'re_password', array('class'=>'help-block error-login')); ?>
        </div>

        <div class="form-group actions">
            <?php echo CHtml::submitButton(Yii::t("app", "Đặt lại mật khẩu"), array('class'=>'btn btn-success btn-block btn-submit btn-lg')); ?>
        </div>
        <?php $this->endWidget(); ?>
	</div>
</div>
