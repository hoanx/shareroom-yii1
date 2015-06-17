<?php
/**
 * Created by ACV.HoaNX.
 * Date: 6/17/15
 */
 ?>

<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <?php echo $form->labelEx($model,'address_detail', array('class'=>'col-sm-2 control-label label-left')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model,'address_detail', array('class'=>'form-control', 'id' => 'autocomplete')); ?>
                <?php echo $form->hiddenField($model,'lat', array('id' => 'lat')); ?>
                <?php echo $form->hiddenField($model,'long', array('id' => 'lng')); ?>
            </div>
            <div class="col-sm-offset-2 col-sm-10 alert-error-form">
                <?php echo $form->error($model,'address_detail'); ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <?php echo $form->labelEx($model,'address', array('class'=>'col-sm-4 control-label label-left')); ?>
            <div class="col-sm-8">
                <?php echo $form->textField($model,'address', array('class'=>'form-control', 'id' => 'route')); ?>
            </div>
            <div class="col-sm-offset-4 col-sm-8 alert-error-form">
                <?php echo $form->error($model,'address'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'district', array('class'=>'col-sm-4 control-label label-left')); ?>
            <div class="col-sm-8">
                <?php echo $form->textField($model,'district', array('class'=>'form-control', 'id' => 'locality')); ?>
            </div>
            <div class="col-sm-offset-4 col-sm-8 alert-error-form">
                <?php echo $form->error($model,'district'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'city', array('class'=>'col-sm-4 control-label label-left')); ?>
            <div class="col-sm-8">
                <?php echo $form->textField($model,'city', array('class'=>'form-control', 'id' => 'administrative_area_level_1')); ?>
            </div>
            <div class="col-sm-offset-4 col-sm-8 alert-error-form">
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
        <div id="map-canvas-new-room">

        </div>
    </div>
</div>

<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            initialize();
        });
    </script>
<?php Yii::app()->clientScript->endScript();?>