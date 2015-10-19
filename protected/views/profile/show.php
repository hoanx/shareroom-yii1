<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */
?>
<div class="prifile-main row">
    <div class="col-md-3 col-sm-4">
        <div class="profile-box profile-picture">
            <div class="picture">
                <img src="<?php echo Yii::app()->createUrl('profile/image', array('id'=>$usersModel->id))?>" class="img-responsive">
            </div>
        </div>
        <?php echo CHtml::link(Yii::t('app', 'Liên lạc với tôi'), 'javascript:void(0)', array('class'=>'btn btn-info btn-block')) ?>
    </div>
    <div class="col-md-9 col-sm-8">
        <h2><?php echo 'Xin chào, tên tôi là ' . $usersModel->first_name . ' ' . $usersModel->last_name ?></h2>
        <div class="help-block">
            <?php if(!empty($rooms)) : ?>
                <a href="#mylisting"><?php echo count($rooms) . ' danh sách'?></a>
            <?php endif; ?>
        </div>
        <div>
            <?php echo nl2br($usersModel->description ) ?>
        </div>
    </div>
</div>
<hr>
<h2 id="mylisting"><?php echo 'Danh sách của tôi' ?></h2>
<div class="row">
    <?php foreach($rooms as $room) : ?>
    <div class="room-search col-md-4" id="room_<?php echo $room->id?>">
        <div class="img-room">
            <?php 
                $images = $room->RoomImages; 
                if (!empty($images)) {
                    $image = $images[0];
                    echo CHtml::link(CHtml::image(Yii::app()->baseUrl . Constant::PATH_UPLOAD_PICTURE . $image->image_name, '', array('class' => 'img-responsive img-show')), array('rooms/view', 'id' => $room->id));
                }
            ?>
            <div class="money-room">
                <?php echo number_format($room->RoomPrice->price) ?> <sup>VND</sup>
            </div>
        </div>
        <h4 style="color: #398fd1;"><?php echo CHtml::link($room->name, array('rooms/view', 'id' => $room->id))?></h4>
        <h5>
        <?php 
            $room_type_title = Constant::getRoomType($room->room_type);
            if($room_type_title  && is_string($room_type_title)) echo $room_type_title . '-';
            echo $room->district . ' - ' . $room->city;
        ?>
        </h5>
    </div>
<?php endforeach; ?>
</div>