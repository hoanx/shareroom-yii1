<?php
/* @var $this RoomsController */
/* @var $model RoomPrice */
/* @var $form CActiveForm */

echo $this->renderPartial('_step_create_room', array(
    'step' => 3
));
?>

<div class="box box-new-room box-price-room">
    <div class="short-description">
        <h3>Đăng tin cho thuê</h3>

        <p>Shareroom.vn giúp bạn tăng thu nhập bằng cách cho thuê nhà/phòng mà bạn không cần dùng đến</p>
    </div>

    <?php
    echo $this->renderPartial('_form_image', array(
        'images' => $images,
        'room' => $room
    ));
    ?>

    <div class="form-group form-actions">
        <div class="pull-right">
            <?php
            echo CHtml::link('<i class="fa fa-play fa-rotate-180"></i>&nbsp;&nbsp;' . Yii::t('app', 'Quay lại'), array('rooms/price', 'id' => $room->id), array(
                'class' => 'btn btn-success btn-lg'
            ));
            ?>
            <?php
            echo CHtml::link(Yii::t('app', 'Tiếp theo') . '&nbsp;&nbsp;<i class="fa fa-play"></i>', array('rooms/complete', 'id' => $room->id), array(
                'class' => 'btn btn-success btn-lg'
            ));
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>