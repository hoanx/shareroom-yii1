<style>
table.table-striped th {
    text-align: right;
    width: 160px;
}
table.table-custom th {
    text-align: left;
    width: auto;
}
</style>
<div class="box box-new-room box-price-room">
    <table class="table table-striped">
        <tr>
            <th>Tên phòng</th>
            <td><?php echo $room->name ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $room->Users->email ?></td>
        </tr>
        <tr>
            <th>Số điện thoại</th>
            <td><?php echo $room->Users->phone_number ?></td>
        </tr>
        <tr>
            <th>Loại phòng</th>
            <td>
                <?php 
                    $room_type_title = $room->getRoomType($room->room_type, true);
                    if($room_type_title) echo implode(', ' , $room_type_title);
                ?>
            </td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td><?php echo $room->status_flg ? '<i class="fa fa-check-circle fa-true fa-lg"></i>' : '<i class="fa fa-times fa-false fa-lg"></i>' ?></td>
        </tr>
        <tr>
            <th>Hình ảnh</th>
            <td>
                <div class="row">
                    <?php if(!empty($room->RoomImages)) : ?>
                        <?php foreach ($room->RoomImages as $image) : ?>
                            <div class="col-md-2 col-xs-3">
                                <?php echo CHtml::image(Yii::app()->baseUrl . Constant::PATH_UPLOAD_PICTURE . $image->image_name, '', array('class' => 'img-responsive')) ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>Số người</th>
            <td><i class="fa fa-users"></i> <?php echo $room->accommodates . ' người' ?></td>
        </tr>
        <tr>
            <th>Số phòng ngủ</th>
            <td><i class="fa fa-home"></i> <?php echo $room->bedrooms . ' phòng ngủ'?></td>
        </tr>
        <tr>
            <th>Số giường</th>
            <td><i class="fa fa-bed"></i> <?php echo $room->beds  . ' giường' ?></td>
        </tr>
        <tr>
            <th>Diện tích</th>
            <td><?php echo $room->room_size  . ' m<sup>2</sup>' ?></td>
        </tr>
        <tr>
            <th>Mô tả</th>
            <td><?php echo $room->description ?></td>
        </tr>
        <tr>
            <th>Tiện nghi</th>
            <td>
                <div class="row">
                    <?php if($room->amenities) : ?>
                        <?php foreach($room->amenities as $amenity) : ?>
                            <div class="col-sm-2"><i class="fa fa-check" style="color: #398fd1;"></i> <?php echo Constant::getAmenities($amenity) ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>Giá phòng</th>
            <td>
                <table class="table table-custom">
                    <tr>
                        <th width="20%">Giá mỗi đêm</th>
                        <td width="30%"><?php echo RoomPrice::displayPrice($room->RoomPrice->price) ?></td>
                        <th width="20%">Giá theo tuần</th>
                        <td width="30%"><?php echo RoomPrice::displayPrice($room->RoomPrice->weekly) ?></td>
                    </tr>
                    <tr>
                        <th>Giá theo tháng</th>
                        <td><?php echo RoomPrice::displayPrice($room->RoomPrice->monthly) ?></td>
                        <th>Phí dọn dẹp</th>
                        <td><?php echo RoomPrice::displayPrice($room->RoomPrice->cleaning_fees) ?></td>
                    </tr>
                    <tr>
                        <th>Phí cho mỗi khách thêm</th>
                        <td><?php echo RoomPrice::displayPrice($room->RoomPrice->additional_guests) ?></td>
                        <th></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Điều kiện hủy bỏ</th>
                        <td><?php echo Constant::getCancellation($room->RoomPrice->cancellation) ?></td>
                        <th>Quy định</th>
                        <td><?php echo $room->RoomPrice->house_rules ?></td>
                    </tr>
                    <tr>
                        <th>Số đêm tối thiểu</th>
                        <td><?php echo $room->RoomPrice->min_nights ?></td>
                        <th>Số đêm tối đa</th>
                        <td><?php echo $room->RoomPrice->max_nights ?></td>
                    </tr>
                    <tr>
                        <th>Thời gian nhận phòng sau</th>
                        <td><?php echo $room->RoomPrice->check_in  . 'h'?></td>
                        <th>Thời gian trả phòng trước</th>
                        <td><?php echo $room->RoomPrice->check_out . 'h'?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th>Địa điểm</th>
            <td>
                <div id="map-canvas-new-room" style="width: 100%;height: 400px;"></div>
            </td>
        </tr>
    </table>
</div>
<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
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
                    fillOpacity: 0.4
                },
            	anchorPoint : new google.maps.Point(0, -29)
            });
        	
        	marker.setMap(map);
        });
    </script>
<?php Yii::app()->clientScript->endScript();?>