<?php
/**
 * Created by ACV.HoaNX.
 * Date: 6/17/15
 */
 ?>
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
            <div class="col-sm-offset-4 col-md-offset-2 col-sm-8 col-md-5 alert-error-form">
                <?php echo $form->error($model,'name'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'description', array('class'=>'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-4 col-md-5">
                <?php echo $form->textArea($model,'description', array('class'=>'form-control', 'row'=>8)); ?>
            </div>
            <div class="col-sm-offset-4 col-md-offset-2 col-sm-8 col-md-5 alert-error-form">
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
            <div class="col-sm-offset-4 col-md-offset-2 col-sm-8 col-md-5 alert-error-form">
                <?php echo $form->error($model,'room_type'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'accommodates', array('class'=>'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-8 col-md-5">
                <?php echo $form->dropdownList($model,'accommodates', Constant::listGuests(), array('class'=>'form-control')); ?>
            </div>
            <div class="col-sm-offset-4 col-md-offset-2 col-sm-8 col-md-5 alert-error-form">
                <?php echo $form->error($model,'accommodates'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'bedrooms', array('class'=>'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-8 col-md-5">
                <?php echo $form->dropdownList($model,'bedrooms', Constant::listBedRooms(), array('class'=>'form-control')); ?>
            </div>
            <div class="col-sm-offset-4 col-md-offset-2 col-sm-8 col-md-5 alert-error-form">
                <?php echo $form->error($model,'bedrooms'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'beds', array('class'=>'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="col-sm-8 col-md-5">
                <?php echo $form->dropdownList($model,'beds', Constant::listBeds(), array('class'=>'form-control')); ?>
            </div>
            <div class="col-sm-offset-4 col-md-offset-2 col-sm-8 col-md-5 alert-error-form">
                <?php echo $form->error($model,'beds'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'room_size', array('class'=>'col-sm-4 col-md-2 control-label label-left')); ?>
            <div class="input-group col-sm-8 col-md-5">
                <?php echo $form->textField($model,'room_size', array('class'=>'form-control')); ?>
                <span class="input-group-addon" id="basic-addon2">m2</span>
            </div>
            <div class="col-sm-offset-4 col-md-offset-2 col-sm-8 col-md-5 alert-error-form">
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


