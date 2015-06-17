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
        <?php $this->renderPartial('_form_address_input', array(
            'model' => $model,
            'form' => $form,
        )); ?>
    </div>

    <?php $this->renderPartial('_form_address_detail', array(
        'model' => $model,
        'form' => $form,
        'user' => $user,
    )); ?>

    <?php $this->renderPartial('_form_security_info', array(
        'model' => $model,
        'form' => $form,
        'user' => $user,
    )); ?>

    <div class="form-group form-actions">
        <div class="pull-right">
            <button type="submit" class="btn btn-success btn-lg"><?php echo(Yii::t('app', 'Tiếp theo')) ?>&nbsp;&nbsp;<i class="fa fa-play"></i></button>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>

