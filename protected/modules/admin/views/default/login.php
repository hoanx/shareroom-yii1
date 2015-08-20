<div class="login-container">
    <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/logo.png', 'Logo', array('class' => 'logo'))?>
    <?php $form=$this->beginWidget('CActiveForm', array(
            'htmlOptions'=>array('class'=>'login-form')
        )); ?>
        <?php echo $form->error($model,'error', array('class'=>'alert alert-danger fade in')); ?>
        <div class="input-row">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <?php echo $form->textField($model,'username', array(
                    'class'=>'form-control', 
                    'placeholder' => $model->getAttributeLabel('username'),
                    'autofocus' => 'autofocus'
                )); ?>
            </div>
            <?php echo $form->error($model,'username', array('class'=>'help-block error-login')); ?>
        </div>


        <div class="input-row">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                <?php echo $form->passwordField($model,'password', array('class'=>'form-control', 'placeholder' => $model->getAttributeLabel('password'))); ?>
            </div>
            <?php echo $form->error($model,'password', array('class'=>'help-block error-login')); ?>
        </div>

        <div class="actions">
            <?php echo CHtml::submitButton(Yii::t("app", "Login"), array('class'=>'btn btn-success btn-block btn-submit')); ?>
        </div>
    <?php $this->endWidget(); ?>
</div>