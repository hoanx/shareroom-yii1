	<button type="button" class="btn btn-default hidden-xs" data-toggle="modal" data-target="#myModal">Bộ lọc</button>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Bộ lọc</h4>
				</div>
				<div class="modal-body">
				    <div class="btn-group" data-toggle="buttons" style="width: 100%;">
        				<label class="btn btn-info <?php echo RoomAddress::checkRoomtype('entire_home') ?>" style="width: 33.33%"><input type="checkbox" autocomplete="off" value="entire_home" name="room_type" <?php echo RoomAddress::checkRoomtype('entire_home', true) ?>> <i class="fa fa-building"></i><br>Cả căn hộ</label> 
        				<label class="btn btn-info <?php echo RoomAddress::checkRoomtype('private_room') ?>" style="width: 33.33%"> <input type="checkbox" autocomplete="off" value="private_room" name="room_type" <?php echo RoomAddress::checkRoomtype('private_room', true) ?>> <i class="fa fa-home"></i><br>Phòng riêng</label>
        				<label class="btn btn-info <?php echo RoomAddress::checkRoomtype('share_room') ?>" style="width: 33.33%"> <input type="checkbox"autocomplete="off" value="share_room" name="room_type" <?php echo RoomAddress::checkRoomtype('share_room', true) ?>> <i class="fa fa-share-alt"></i><br>Phòng chia sẻ</label>
        			</div>
        			<br><br>
        			<div class="panel panel-default">
        				<div class="panel-heading">
        					<h3 class="panel-title"><?php echo Yii::t('app', 'Giá') ?></h3>
        				</div>
        				<div class="panel-body">
        	    		    <div class="row">
                			    <div class="col-md-12">
                			        <?php 
                    			        if(isset($_GET['price']) && $_GET['price']) {
                    			            $price = explode(",", $_GET['price']);
                    			        } else {
                    			            $price = array($minprice, $maxprice);
                    			        }
                			        ?>
                			        <input type="text" id="range" value="" name="range" />
                			    </div>
                			</div>
        				</div>
        			</div>
        			
        			<div class="panel panel-default">
        				<div class="panel-heading">
        					<h3 class="panel-title"><?php echo Yii::t('app', 'Tiện nghi') ?></h3>
        				</div>
        				<div class="panel-body">
        	    		    <div class="row">
                			    <?php 
                			        if(isset($_GET['amenities']) && $_GET['amenities']) {
                			            $amenities = explode(",", $_GET['amenities']);
                			        } else {
                			            $amenities = array();
                			        }
                			        $countAm = RoomAddress::listAmenities();
                			        
                			        foreach($model as $room) {
                			            $ams = unserialize($room->amenities);
                			            if(!empty($ams)) {
                			                foreach($ams as $am) {
                			                    $countAm[$am]++;
                			                }
                			            }
                			        }
                			        
                			        $arrayAmenities = Constant::getAmenities();
                			        foreach ($arrayAmenities as $k => $v) :
            			        ?>
                			        <div class="col-md-6">
                			            <div class="checkbox">
                			                <label>
                			                    <input value="<?php echo $k ?>" type="checkbox" name="amenities" <?php if($countAm[$k] == 0) echo 'disabled' ?> <?php if(in_array( $k, $amenities)) echo 'checked' ?>>
                			                    <?php echo $v ?> (<?php echo $countAm[$k] ?>) 
            			                    </label>
            			                </div>
            			            </div>
            			        <?php 
                			        endforeach;
                			    ?>
                			</div>
        				</div>
        			</div>
				</div>
			</div>
		</div>
	</div>
	<?php if($ajax) :?>
	<script>
    jQuery('#myModal').addClass('in').css('display', 'block');
    jQuery('.modal-header button').click(function(){
    	jQuery('#myModal').removeClass('in').css('display', 'none');
    	jQuery('.modal-backdrop').remove();
    	
    });
    
	</script>
    <?php endif; ?>