<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/28/15
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
                <span><?php echo(Yii::t('app', 'Cách thức nhận thanh toán')) ?></span>
            </div>
            <div class="panel-body">
                <h5><?php echo Yii::t('app', 'Phương thức thanh toán mặc đinh : chuyển khoản ngân hàng') ?></h5>
                <br>
                <div class="form-group row">
                    <?php echo $form->labelEx($userBankModel,'bank_number', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($userBankModel,'bank_number', array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($userBankModel,'bank_number'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?php echo $form->labelEx($userBankModel,'bank_name', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($userBankModel,'bank_name', array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($userBankModel,'bank_name'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?php echo $form->labelEx($userBankModel,'bank_branch', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($userBankModel,'bank_branch', array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($userBankModel,'bank_branch'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?php echo $form->labelEx($userBankModel,'bank_holder_name', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($userBankModel,'bank_holder_name', array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($userBankModel,'bank_holder_name'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">&nbsp;</div>
                    <div class="col-sm-5">
                        <?php echo CHtml::htmlButton(Yii::t('app', 'Lưu lại'), array('type' => 'submit', 'class' => 'btn btn-success btn-lg btn-submit'))?>
                    </div>

                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>

</div>
