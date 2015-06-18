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

    <?php $this->renderPartial('_form_price', array(
        'model' => $model,
        'form' => $form,
    )); ?>

    <div class="form-group form-actions">
        <div class="pull-right">
            <?php
            echo CHtml::link('<i class="fa fa-play fa-rotate-180"></i>&nbsp;&nbsp;' . Yii::t('app', 'Quay lại'), array('rooms/new', 'id' => $model->room_address_id), array(
                'class' => 'btn btn-success btn-lg'
            ));
            ?>
            <button type="submit" class="btn btn-success btn-lg"><?php echo(Yii::t('app', 'Tiếp theo')) ?>&nbsp;&nbsp;<i
                    class="fa fa-play"></i></button>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->