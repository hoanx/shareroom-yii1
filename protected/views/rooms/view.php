<div class="box box-new-room box-price-room">
    <?php 
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $this->breadcrumbs,
    ));
    ?>
    <div class="row" id="room-info">
        <div class="col-sm-8">
            <h3 style="color: #398fd1;"><?php echo $room->name ?></h3>
            <h5>
            <?php 
                $room_type_title = $room->getRoomType($room->room_type, true);
                if($room_type_title) echo implode(', ' , $room_type_title) . ' - ';
                echo $room->district . ' - ' . $room->city;
            ?>
            </h5>
            <div class="slider theme-default">
                <?php if(!empty($room->RoomImages)) : ?>
                    <div id="slider" class="nivoSlider">
                        <?php foreach ($room->RoomImages as $image) : ?>
                            <?php echo CHtml::image(Yii::app()->baseUrl . Constant::PATH_UPLOAD_PICTURE . $image->image_name, '', array('data-transition' => 'slideInLeft')) ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row room-extra">
                <?php $room_type =  $room->getRoomType($room->room_type); ?>
                <?php if($room_type) : ?>
                    <?php foreach($room_type as $rt) : ?>
                        <div class="col-sm-2 col-xs-4"><?php $room->iconRoomType($rt) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="col-sm-2 col-xs-4"><i class="fa fa-users"></i><br><?php echo $room->accommodates . ' người' ?></div>
                <div class="col-sm-2 col-xs-4"><i class="fa fa-home"></i><br><?php echo $room->bedrooms . ' phòng ngủ'?></div>
                <div class="col-sm-2 col-xs-4"><i class="fa fa-bed"></i><br><?php echo $room->beds  . ' giường' ?></div>
            </div>
            <div class="room-desc">
                <h4>Mô tả</h4>
                <?php echo $room->description ?>
                <h4>Tiện nghi</h4>
                <div class="row">
                    <?php if($room->amenities) : ?>
                        <?php foreach($room->amenities as $amenity) : ?>
                            <div class="col-sm-6"><i class="fa fa-check" style="color: #398fd1;"></i> <?php echo Constant::getAmenities($amenity) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <h4>Giá phòng</h4>
                <div>
                    <table class="table table-striped">
                        <tr>
                            <td>Phí dọn dẹp</td>
                            <td>
                                <?php 
                                if(!empty($room->RoomPrice->cleaning_fees)) {
                                    echo number_format($room->RoomPrice->cleaning_fees) . ' VND';
                                } else {
                                    echo "<b>Không có phí</b>";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Phí cho mỗi khách thêm</td>
                            <td>
                                <?php 
                                if(!empty($room->RoomPrice->additional_guests)) {
                                    echo number_format($room->RoomPrice->additional_guests) . ' VND';
                                } else {
                                    echo "<b>Không có phí</b>";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Điều kiện hủy bỏ</td>
                            <td><?php echo Constant::getCancellation($room->RoomPrice->cancellation) ?></td>
                        </tr>
                    </table>
                </div>
                <h4>Địa điểm</h4>
                <div>
                    <div id="map-canvas-new-room" style="width: 100%;height: 400px;"></div>
                </div>
                <h4>Quy định khác</h4>
                <div>
                    <?php 
                        if(!empty($room->RoomPrice->house_rules)) {
                            echo $room->RoomPrice->house_rules;
                        } else {
                            echo "Chủ nhà không thiết lập quy định nào";
                        }
                    ?>
                </div>
                <h4>Chi tiết khác</h4>
                <div>
                    <table class="table table-striped">
                        <tr>
                            <td>Nhận phòng</td>
                            <td><b><?php echo $room->RoomPrice->check_in . 'h'?></b></td>
                        </tr>
                        <tr>
                            <td>Trả phòng</td>
                            <td><b><?php echo $room->RoomPrice->check_out . 'h'?></b></td>
                        </tr>
                        <tr>
                            <td>Diện tích</td>
                            <td><b><?php echo $room->room_size . ' m<sup>2</sup>'?></b></td>
                        </tr>
                        <tr>
                            <td>Số đêm tối thiểu</td>
                            <td><b><?php echo $room->RoomPrice->min_nights . ' đêm'?></b></td>
                        </tr>
                        <tr>
                            <td>Số đêm tối đa</td>
                            <td><b><?php echo $room->RoomPrice->max_nights . ' đêm'?></b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4 hidden-xs" id="room-checkin">
            <div class="more-width">
                <h3><?php echo number_format($room->RoomPrice->price) . ' VND' ?><span>Giá trung bình theo đêm</span></h3>
                <div class="checkin-content">
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'htmlOptions' => array(
                            'class' => 'form-horizontal form-booking'
                        ),
                    )); ?>

                    <?php $this->renderPartial('_form_booking', array(
                        'paymentForm' => $paymentForm,
                        'form' => $form,
                        'listGuest' => $listGuest,
                        'room' => $room,
                        'mobile' => 0
                    )); ?>

                    <div style="margin-top: 20px">
                        <button type="submit" class="btn btn-danger btn-block">Đặt chỗ</button>
                    </div>
                    <?php $this->endWidget(); ?>
                    <div style="margin-top: 20px">
                        <?php if(Yii::app()->user->isGuest) : ?>
                            <?php echo CHtml::link('<i class="fa fa-heart-o"></i> Đưa vào mục yêu thích', array('site/signin'), array('class' => 'btn btn-default btn-block'))?>
                        <?php else: ?>
                            <?php if($wishlist) : ?>
                                <button type="button" class="btn btn-default btn-block" id="add-wishlist"><i class="fa fa-heart" style="color: #ff5a5f;"></i> Xóa khỏi mục yêu thích</button>
                            <?php else: ?>
                                <button type="button" class="btn btn-default btn-block" id="add-wishlist"><i class="fa fa-heart-o"></i> Đưa vào mục yêu thích</button>
                            <?php endif; ?>
                        <?php endif;?>
                    </div>
                    <hr>
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-4 col-sm-6">
                            <a href="<?php echo $this->createUrl('profile/show', array('id'=>$room->Users->id)) ?>">
                                <?php echo CHtml::image(Yii::app()->createUrl('profile/image', array('id'=>$room->Users->id)), '', array('class' => 'img-responsive image-user')) ?>
                            </a>
                        </div>
                        <div class="col-md-8 col-sm-6">
                            <h5 style="margin: 3px 0;"><?php echo $room->Users->first_name ?></h5>
                            <div><?php echo "Là thành viên từ " . date('m/Y' , strtotime($room->Users->created))?></div>
                        </div>
                    </div>
                    <div style="margin-top: 20px">
                        <div><?php echo "Chia sẻ bài đăng này" ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>            
</div>
<div class="row visible-xs modal-booked">
<button class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#myModal">Đặt chỗ</button>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'htmlOptions' => array(
                    'class' => 'form-horizontal form-booking'
                ),
            )); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Đặt chỗ</h4>
			</div>
			<div class="modal-body">
                <?php $this->renderPartial('_form_booking', array(
                    'paymentForm' => $paymentForm,
                    'form' => $form,
                    'listGuest' => $listGuest,
                    'room' => $room,
                    'mobile' => 1
                )); ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
				<button type="submit" class="btn btn-primary">Đặt chỗ</button>
			</div>
            <?php $this->endWidget(); ?>
		</div>
	</div>
</div>
<div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES * * */
    var disqus_shortname = 'shareroomvn1';
    
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
        	jQuery('#slider').nivoSlider({
                controlNav: false,
				animSpeed: 300, 
            });
        	jQuery('#add-wishlist').click(function() {
        		jQuery.ajax({
                    url: "<?php echo Yii::app()->createUrl('rooms/wishlist', array('room_address_id' => $room->id)) ?>",
            	}).done(function(data) {
            	    jQuery("#add-wishlist").html(data);
            	});
    	    });
        	jQuery(function() {
        	    var $sidebar   = jQuery("#room-checkin .more-width"), 
        	        $window    = jQuery(window),
        	        $divheight = jQuery(".box-price-room").height(),
        	        offset     = $sidebar.offset(),
        	        topPadding = 15;
        	    $window.scroll(function() {
        	    	jQuery('#ui-datepicker-div').css("display", "none");
        	        if ($window.scrollTop() > offset.top) {
            	        if(($window.scrollTop() + offset.top + topPadding) < $divheight) {
            	        	$sidebar.css('margin-top', $window.scrollTop() - offset.top + topPadding);
            	        }
        	            
        	        } else {
            	        $sidebar.css('margin-top', 0);
        	        }
        	    });
        	    
        	});
            
            var mapOptions = {
                zoom: 15,
                scrollwheel: false,
                center:  new google.maps.LatLng(<?php echo $room->lat ?>, <?php echo $room->long ?>)
            };
            
            map = new google.maps.Map(document.getElementById('map-canvas-new-room'), mapOptions);
            marker = new google.maps.Marker({
            	position: new google.maps.LatLng(<?php echo $room->lat ?>, <?php echo $room->long ?>),
                map : map,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 50,
                    strokeWeight: 1,
                    strokeColor: '#398fd1',
                    fillColor: '#398fd1',
                    fillOpacity: 0.4,
                },
            	anchorPoint : new google.maps.Point(0, -29)
            });
        	
        	marker.setMap(map);
        });
    </script>
<?php Yii::app()->clientScript->endScript();?>