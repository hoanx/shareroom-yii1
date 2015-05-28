<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */

echo $this->renderPartial('_menu_profile');
?>
<div class="profile-edit">

    <!-- Nav tabs -->
    <?php echo $this->renderPartial('_menu_profile_detail'); ?>

    <!-- Tab panes -->
    <div class="profile-index">
        <?php $form=$this->beginWidget('CActiveForm'); ?>
        <div class="panel panel-default profile-box profile-info">
            <div class="panel-heading box-header">
                <span><?php echo(Yii::t('app', 'Đổi mật khẩu')) ?></span>
            </div>
            <div class="panel-body">
                <div class="form-group row">
                    <?php echo $form->labelEx($changePassModel,'current_pass', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->passwordField($changePassModel,'current_pass', array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($changePassModel,'current_pass'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?php echo $form->labelEx($changePassModel,'new_pass', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->passwordField($changePassModel,'new_pass', array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($changePassModel,'new_pass'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?php echo $form->labelEx($changePassModel,'re_new_pass', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->passwordField($changePassModel,'re_new_pass', array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($changePassModel,'re_new_pass'); ?>
                    </div>
                </div>
                <div class="form-actions">
                    <?php echo CHtml::htmlButton(Yii::t('admin', 'Change'), array('type' => 'submit', 'class' => 'btn btn-primary btn-submit'))?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>

</div>
