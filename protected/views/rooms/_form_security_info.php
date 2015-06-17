<?php
/**
 * Created by ACV.HoaNX.
 * Date: 6/17/15
 */
 ?>

<div class="panel panel-default box box-amenities">
    <div class="panel-heading">
        <h4><i class="fa fa-lock"></i><?php echo Yii::t('app', 'Thông tin được bảo mật') ?></h4>
    </div>
    <div class="panel-body">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo $form->labelEx($user,'email', array('class'=>'col-sm-4 control-label label-left')); ?>
                <div class="col-sm-8">
                    <?php echo $form->textField($user,'email', array('class'=>'form-control')); ?>
                </div>
                <div class="col-sm-offset-4 col-sm-8 alert-error-form">
                    <?php echo $form->error($user, 'email'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($user,'phone_number', array('class'=>'col-sm-4 control-label label-left')); ?>
                <div class="col-sm-8">
                    <?php echo $form->textField($user,'phone_number', array('class'=>'form-control')); ?>
                </div>
                <div class="col-sm-offset-4 col-sm-8 alert-error-form">
                    <?php echo $form->error($user, 'phone_number'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-md-offset-2">
            <div class="text-note">
                <i class="fa fa-lock"></i>
                    <span>
                    Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các thông tin liên
                    lạc khác cho đến khi khách xác nhận đặt chỗ với bạn.
                    </span>
            </div>
        </div>
    </div>
</div>