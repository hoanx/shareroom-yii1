<?php
/* @var $this ManagerController */
/* @var $model Admin */
/* @var $form CActiveForm */
?>

<section class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'admin-form',
        'enableAjaxValidation' => false,
    )); ?>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'username'); ?>
                <?php echo $form->textField($model, 'username', array(
                    'size' => 60,
                    'maxlength' => 255,
                    'class' => 'form-control'
                )); ?>
                <?php echo $form->error($model, 'username'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->textField($model, 'email', array(
                    'size' => 60,
                    'maxlength' => 255,
                    'class' => 'form-control'
                )); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'role'); ?>
                <?php echo $form->dropDownList($model, 'role', Constant::listRoles(), array(
                    'class' => 'form-control'
                )); ?>
                <?php echo $form->error($model, 'role'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'password'); ?>
                <?php echo $form->textField($model, 'password', array(
                    'size' => 60,
                    'maxlength' => 255,
                    'class' => 'form-control'
                )); ?>
                <?php if(!$model->isNewRecord): ?>
                <p class="help-block"><?php echo(Yii::t('app', 'Để trống nêu không muốn đổi mật khẩu.')) ?></p>
                <?php endif ?>
                <?php echo $form->error($model, 'password'); ?>
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <?php echo $form->checkBox($model, 'sent_pass_to_email'); ?>
                        <?php echo $model->getAttributeLabel('sent_pass_to_email') ?>
                    </label>
                </div>
            </div>

            <hr>
            <div class="form-actions">
                <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Tạo mới') : Yii::t('app', 'Cập nhật'),
                    array(
                        'class' => 'btn btn-success btn-submit',
                    )); ?>
            </div>

        </div>
    </div>

    <?php $this->endWidget(); ?>

</section><!-- form -->