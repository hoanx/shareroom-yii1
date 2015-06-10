<?php
/**
 * Created by ACV.HoaNX.
 * Date: 6/3/15
 */
echo $this->renderPartial('_step_create_room', array(
    'step' => 1
));
?>

<div class="box box-new-room">
    <div class="short-description">
        <h3>Đăng tin cho thuê</h3>
        <p>Shareroom.vn giúp bạn tăng thu nhập bằng cách cho thuê nhà/phòng mà bạn không cần dùng đến</p>
    </div>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'htmlOptions' => array(
            'class' => 'form-horizontal'
        ),

    )); ?>
    <div class="box box-address-input">
        <div class="row">

            <div class="col-xs-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model,'address_detail', array('class'=>'col-sm-4 col-md-3 control-label')); ?>
                    <div class="col-sm-8 col-md-9">
                        <?php echo $form->textField($model,'address_detail', array('class'=>'form-control')); ?>
                    </div>
                    <div class="ol-sm-offset-4 col-sm-8 alert-error-form">
                        <?php echo $form->error($model,'address_detail'); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <?php echo $form->labelEx($model,'address', array('class'=>'col-sm-4 control-label')); ?>
                    <div class="col-sm-8">
                        <?php echo $form->textField($model,'address', array('class'=>'form-control')); ?>
                    </div>
                    <div class="ol-sm-offset-4 col-sm-8 alert-error-form">
                        <?php echo $form->error($model,'address'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'district', array('class'=>'col-sm-4 control-label')); ?>
                    <div class="col-sm-8">
                        <?php echo $form->textField($model,'district', array('class'=>'form-control')); ?>
                    </div>
                    <div class="ol-sm-offset-4 col-sm-8 alert-error-form">
                        <?php echo $form->error($model,'district'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'city', array('class'=>'col-sm-4 control-label')); ?>
                    <div class="col-sm-8">
                        <?php echo $form->textField($model,'city', array('class'=>'form-control')); ?>
                    </div>
                    <div class="ol-sm-offset-4 col-sm-8 alert-error-form">
                        <?php echo $form->error($model,'city'); ?>
                    </div>
                </div>

                <div class="col-sm-offset-4 col-sm-8 text-note">
                    <i class="fa fa-lock"></i>
                    <span>
                    Để bảo vệ quyền riêng tư chúng tôi sẽ giữ kín địa chỉ, số điện thoại cũng như các thông tin liên
                    lạc khác cho đến khi khách xác nhận đặt chỗ với bạn.
                    </span>
                </div>
            </div>
            <div class="col-md-6">
            </div>
        </div>


    </div>

    <div class="panel panel-default box box-address-detail">
        <div class="panel-heading">
            <h4>Về địa điểm của bạn</h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo $form->labelEx($model,'name', array('class'=>'col-sm-4 col-md-2 control-label label-left')); ?>
                <div class="col-sm-8 col-md-5">
                    <?php echo $form->textField($model,'name', array('class'=>'form-control')); ?>
                </div>
                <div class="ol-sm-offset-4 col-sm-8 col-md-5 alert-error-form">
                    <?php echo $form->error($model,'name'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'description', array('class'=>'col-sm-4 col-md-2 control-label label-left')); ?>
                <div class="col-sm-4 col-md-5">
                    <?php echo $form->textArea($model,'description', array('class'=>'form-control', 'row'=>8)); ?>
                </div>
                <div class="ol-sm-offset-4 col-sm-8 col-md-5 alert-error-form">
                    <?php echo $form->error($model,'description'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'room_type', array('class'=>'col-sm-4 col-md-2 control-label label-left')); ?>
                <div class="col-sm-4 col-md-10">
                    <?php echo $form->checkBoxList($model,'room_type', Constant::getRoomType(), array(
                        'template'=>'<div class="col-sm-4 col-md-3">{input} {label}</div>',
                        'separator' => '',
                    )); ?>
                </div>
                <div class="ol-sm-offset-4 ol-md-offset-2 col-sm-8 col-md-10 alert-error-form">
                    <?php echo $form->error($model,'room_type'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'accommodates', array('class'=>'col-sm-4 col-md-2 control-label label-left')); ?>
                <div class="col-sm-8 col-md-5">
                    <?php echo $form->dropdownList($model,'accommodates', Constant::listGuests(), array('class'=>'form-control')); ?>
                </div>
                <div class="ol-sm-offset-4 col-sm-8 col-md-5 alert-error-form">
                    <?php echo $form->error($model,'accommodates'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'bedrooms', array('class'=>'col-sm-4 col-md-2 control-label label-left')); ?>
                <div class="col-sm-8 col-md-5">
                    <?php echo $form->dropdownList($model,'bedrooms', Constant::listBedRooms(), array('class'=>'form-control')); ?>
                </div>
                <div class="ol-sm-offset-4 col-sm-8 col-md-5 alert-error-form">
                    <?php echo $form->error($model,'bedrooms'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'beds', array('class'=>'col-sm-4 col-md-2 control-label label-left')); ?>
                <div class="col-sm-8 col-md-5">
                    <?php echo $form->dropdownList($model,'beds', Constant::listBeds(), array('class'=>'form-control')); ?>
                </div>
                <div class="ol-sm-offset-4 col-sm-8 col-md-5 alert-error-form">
                    <?php echo $form->error($model,'beds'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'room_size', array('class'=>'col-sm-4 col-md-2 control-label label-left')); ?>
                <div class="input-group col-sm-8 col-md-5">
                    <?php echo $form->textField($model,'room_size', array('class'=>'form-control')); ?>
                    <span class="input-group-addon" id="basic-addon2">m2</span>
                </div>
                <div class="ol-sm-offset-4 col-sm-8 col-md-5 alert-error-form">
                    <?php echo $form->error($model,'room_size'); ?>
                </div>
            </div>


        </div>
    </div>

    <div class="panel panel-default box box-amenities">
        <div class="panel-heading">
            <h4>Tiện nghi</h4>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <div class="col-sm-12">
                    <?php echo $form->checkBoxList($model,'amenities', Constant::getAmenities(), array(
                        'template'=>'<div class="col-md-4">{input} {label}</div>',
                        'separator' => '',
                    )); ?>
                </div>
                <div class="col-sm-12 alert-error-form">
                    <?php echo $form->error($model,'amenities'); ?>
                </div>
            </div>

        </div>
    </div>

    <div class="panel panel-default box box-amenities">
        <div class="panel-heading">
            <h4><i class="fa fa-lock"></i><?php echo Yii::t('app', 'Thông tin được bảo mật') ?></h4>
        </div>
        <div class="panel-body">
            <div class="col-md-8">

            </div>
            <div class="col-md-4">
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

    <div class="form-group form-actions">
        <div class="pull-right">
            <button type="submit" class="btn btn-success btn-lg"><?php echo(Yii::t('app', 'Tiếp theo')) ?>&nbsp;&nbsp;<i class="fa fa-play"></i></button>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>
