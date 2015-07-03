<?php
echo $this->renderPartial('_menu_profile');
?>
<?php if($wishlist) : ?>
    <?php foreach($wishlist as $data) : ?>
        <div class="row">
            <div class="col-md-3">
                <div class="spaces-image-room">
                    <img src="<?php echo RoomImages::getImageByRoomaddress($data->RoomAddress->id)?>" class="img-responsive" alt="<?php echo $data->RoomAddress->name ?>">
                </div>
            </div>
            <div class="col-md-6">
                <h4 style="color: #398fd1;margin-top: 10px;"><?php echo CHtml::link($data->RoomAddress->name, array('rooms/view', 'id' => $data->RoomAddress->id))?></h4>
                <h5>
                <?php 
                    $room_type_title = RoomAddress::getRoomType($data->RoomAddress->room_type, true);
                    if($room_type_title) echo implode(', ' , $room_type_title) . ' - ';
                    echo $data->RoomAddress->district . ' - ' . $data->RoomAddress->city;
                ?>
                </h5>
                <div>
                    <?php echo CHtml::link('Xem chi tiết', array('rooms/view', 'id' => $data->RoomAddress->id), array('class' => 'btn btn-default'))?>
                    <?php echo CHtml::link('Xóa khỏi mục yêu thích', '#', array('class' => 'btn btn-default remove-wishlist', 'data-link' => Yii::app()->createUrl('rooms/wishlist', array('room_address_id' => $data->RoomAddress->id))))?>
                </div>
            </div>
            <div class="col-md-3">
                <h3 style="margin-top: 10px;"><?php echo number_format($data->RoomAddress->RoomPrice->price) ?><sup style="font-size: 10px;top: -1em;"> VND</sup></h3>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
        	jQuery('.remove-wishlist').click(function() {
            	var row = jQuery(this).closest('.row');
        		jQuery.ajax({
                    url: jQuery(this).data('link'),
            	}).done(function(data) {
            		row.hide();
            	});
    	    });

        });
    </script>
<?php Yii::app()->clientScript->endScript();?>