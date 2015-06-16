<?php
/* @var $this RoomsController */
/* @var $model RoomPrice */
/* @var $form CActiveForm */

echo $this->renderPartial('_step_create_room', array(
    'step' => 2
));
?>

<div class="box box-new-room box-price-room">
    <div class="short-description">
        <h3>Đăng tin cho thuê</h3>
        <p>Shareroom.vn giúp bạn tăng thu nhập bằng cách cho thuê nhà/phòng mà bạn không cần dùng đến</p>
    </div>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'room-price-price-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // See class documentation of CActiveForm for details on this,
    // you need to use the performAjaxValidation()-method described there.
    'enableAjaxValidation' => false,
)); ?>

<div class="panel panel-default box box-price">
    <div class="panel-heading">
        <h4>Mức giá cơ bản</h4>
    </div>
    <div class="panel-body">
        <p>
            Đây là giá cơ sở tính theo đêm cho danh sách của bạn. Nếu không có các tùy chỉnh giá khác,
            giá cơ bản này sẽ được áp dụng cho tất cả các ngày trong lịch của bạn.
        </p>

        <div class="form-group row">
            <label class="col-sm-4 col-md-2 control-label label-left">
                Loại tiền tệ
            </label>

            <div class="col-sm-8 col-md-3">
                VND - Việt Nam đồng
            </div>
        </div>

        <div class="form-group row">
            <?php echo $form->labelEx($model, 'price', array('class' => 'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-8 col-md-3">
                <?php echo $form->textField($model, 'price', array('class' => 'form-control')); ?>
            </div>
            <div class="col-sm-offset-4 col-sm-8 col-md-offset-2 col-md-7 alert-error-form">
                <?php echo $form->error($model, 'price'); ?>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default box box-price">
    <div class="panel-heading">
        <h4>Định giá dài hạn</h4>
    </div>
    <div class="panel-body">
        <p>
            Nếu bạn muốn có giá theo tuần hoặc theo tháng dành cho lưu trú dài hạn, bạn có thể sử dụng tùy chọn này.
            Thông thường chủ khách sạn sử dụng tùy chọn này để cung cấp giảm giá cho đợt lưu trú dài hơn.
        </p>

        <div class="form-group row">
            <?php echo $form->labelEx($model, 'weekly', array('class' => 'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-8 col-md-3">
                <?php echo $form->textField($model, 'weekly', array('class' => 'form-control')); ?>
            </div>
            <div class="col-md-7 hint">
                Du khách sẽ được báo giá này cho bất kỳ đợt đặt phòng nào từ 7 đêm trở lên
            </div>
            <div class="col-sm-offset-4 col-sm-8 col-md-offset-2 col-md-5 alert-error-form">
                <?php echo $form->error($model, 'weekly'); ?>
            </div>
        </div>

        <div class="form-group row">
            <?php echo $form->labelEx($model, 'monthly', array('class' => 'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-8 col-md-3">
                <?php echo $form->textField($model, 'monthly', array('class' => 'form-control')); ?>
            </div>
            <div class="col-md-7 hint">
                Khách sẽ được báo giá này cho bất kỳ đặt chỗ từ 28 đêm trở lên
            </div>
            <div class="col-sm-offset-4 col-sm-8 col-md-offset-2 col-md-5 alert-error-form">
                <?php echo $form->error($model, 'monthly'); ?>
            </div>
        </div>

        <p>
            Lưu ý: Để biết thêm số đêm cộng thêm vượt quá một tuần hay một tháng, chúng tôi sẽ áp dụng một giá
            hàng đêm theo tỷ lệ dựa trên giá dài hạn của bạn.
        </p>

    </div>
</div>

<div class="panel panel-default box box-price">
    <div class="panel-heading">
        <h4>Chi phí bổ sung</h4>
    </div>
    <div class="panel-body">
        <div class="form-group row">
            <?php echo $form->labelEx($model, 'additional_guests', array('class' => 'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-8 col-md-3">
                <?php echo $form->textField($model, 'additional_guests', array('class' => 'form-control')); ?>
            </div>
            <div class="col-md-7">
                Du khách sẽ được báo giá này cho bất kỳ đợt đặt phòng nào từ 7 đêm trở lên
            </div>
            <div class="col-sm-offset-4 col-sm-8 col-md-offset-2 col-md-5 alert-error-form">
                <?php echo $form->error($model, 'additional_guests'); ?>
            </div>
        </div>

        <div class="form-group row">
            <?php echo $form->labelEx($model, 'cleaning_fees', array('class' => 'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-8 col-md-3">
                <?php echo $form->textField($model, 'cleaning_fees', array('class' => 'form-control')); ?>
            </div>
            <div class="col-md-7">
                Khách sẽ được báo giá này cho bất kỳ đặt chỗ từ 28 đêm trở lên
            </div>
            <div class="col-sm-offset-4 col-sm-8 col-md-offset-2 col-md-5 alert-error-form">
                <?php echo $form->error($model, 'cleaning_fees'); ?>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default box box-price">
    <div class="panel-heading">
        <h4>Điều khoản</h4>
    </div>
    <div class="panel-body">
        <div class="form-group row">
            <?php echo $form->labelEx($model, 'cancellation', array('class' => 'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-8 col-md-8">
                <?php echo $form->dropdownList($model, 'cancellation', Constant::getCancellation(), array('class' => 'form-control')); ?>
            </div>
            <div class="col-sm-offset-4 col-sm-8 col-md-offset-2 col-md-8 alert-error-form">
                <?php echo $form->error($model, 'cancellation'); ?>
            </div>
        </div>

        <div class="form-group row">
            <?php echo $form->labelEx($model,'house_rules', array('class'=>'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-4 col-md-5">
                <?php echo $form->textArea($model,'house_rules', array('class'=>'form-control ftextarea', 'row'=>15)); ?>
            </div>
            <div class="col-sm-offset-4 col-sm-8 col-md-5 alert-error-form">
                <?php echo $form->error($model,'house_rules'); ?>
            </div>
        </div>

        <div class="form-group row">
            <?php echo $form->labelEx($model, 'min_nights', array('class' => 'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-8 col-md-3">
                <?php echo $form->dropdownList($model, 'min_nights', Constant::getMinNights(), array('class' => 'form-control')); ?>
            </div>
            <div class="col-md-7">
            </div>
            <div class="col-sm-offset-4 col-sm-8 col-md-offset-2 col-md-5 alert-error-form">
                <?php echo $form->error($model, 'min_nights'); ?>
            </div>
        </div>

        <div class="form-group row">
            <?php echo $form->labelEx($model, 'max_nights', array('class' => 'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-8 col-md-3">
                <?php echo $form->dropdownList($model, 'max_nights', Constant::getMaxNights(), array('class' => 'form-control')); ?>
            </div>
            <div class="col-md-7">
            </div>
            <div class="col-sm-offset-4 col-sm-8 col-md-offset-2 col-md-5 alert-error-form">
                <?php echo $form->error($model, 'max_nights'); ?>
            </div>
        </div>


        <div class="form-group row">
            <?php echo $form->labelEx($model, 'check_in', array('class' => 'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-8 col-md-3">
                <?php echo $form->dropdownList($model, 'check_in', Constant::getTimeCheck(), array('class' => 'form-control')); ?>
            </div>
            <div class="col-md-7">
            </div>
            <div class="col-sm-offset-4 col-sm-8 col-md-offset-2 col-md-5 alert-error-form">
                <?php echo $form->error($model, 'check_in'); ?>
            </div>
        </div>

        <div class="form-group row">
            <?php echo $form->labelEx($model, 'check_out', array('class' => 'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-8 col-md-3">
                <?php echo $form->dropdownList($model, 'check_out', Constant::getTimeCheck(), array('class' => 'form-control')); ?>
            </div>
            <div class="col-md-7">
            </div>
            <div class="col-sm-offset-4 col-sm-8 col-md-offset-2 col-md-5 alert-error-form">
                <?php echo $form->error($model, 'check_out'); ?>
            </div>
        </div>
    </div>
</div>
        
<div class="form-group form-actions">
    <div class="pull-right">
        <?php 
            echo CHtml::link('<i class="fa fa-play fa-rotate-180"></i>&nbsp;&nbsp;' . Yii::t('app', 'Quay lại'), array('rooms/new', 'id' => $model->room_address_id), array(
                 'class' => 'btn btn-success btn-lg'       
            ));
        ?>
        <button type="submit" class="btn btn-success btn-lg"><?php echo(Yii::t('app', 'Tiếp theo')) ?>&nbsp;&nbsp;<i class="fa fa-play"></i></button>
    </div>
    <div class="clearfix"></div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->