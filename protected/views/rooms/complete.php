<div class="box box-new-room box-price-room">
    <div class="short-description">
        <h3>Đăng tin cho thuê</h3>
        <p>Shareroom.vn giúp bạn tăng thu nhập bằng cách cho thuê nhà/phòng mà bạn không cần dùng đến</p>
    </div>
    
    <div class="panel panel-default box box-price">
        <div class="panel-heading">
            <h4>Bước tiếp theo?</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="box-image">
                        <?php
                            if($image) {
                                echo CHtml::link(CHtml::image(Yii::app()->baseUrl . Constant::PATH_UPLOAD_PICTURE . $image->image_name), array('rooms/view', 'id' => $room->id));
                            } 
                        ?>
                        <div>
                            <div class="title"><?php echo CHtml::link($room->name, array('rooms/view', 'id' => $room->id)); ?></div>
                            <div class="city pull-left"><?php echo $room->city ?></div>
                            <div class="price pull-right"><?php echo number_format($room->RoomPrice->price) ?> VND</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="text-center" style="margin-top: 20px;"><?php echo CHtml::link(Yii::t('app', 'Xem lại bài đăng của bạn.'), array('rooms/view', 'id' => $room->id)); ?></div>
                </div>
                <div class="col-md-8 col-md-offset-1">
                    <div class="complete-title"><i class="fa fa-calendar fa-2x fa-fw"></i><span><?php echo Yii::t('app', 'Cập nhật lịch')?></span></div>
                    <div class="complete-content">
                        Đánh dấu ngày bạn chọn với trạng thái 'Còn trống' hay 'Không còn trống' rồi thiết lập giá trên lịch của bạn. Với cách này, bạn sẽ chỉ nhận yêu cầu từ khách cho những ngày còn trống. Cập nhật lịch cũng giúp bài đăng của bạn được ưu tiên hiện lên trước trên trang tìm kiếm.
                        <p><?php echo CHtml::link(Yii::t('app', 'Cập nhật lịch cho bài đăng này.'), array('spaces/index', 'id' => $room->id)); ?></p>
                    </div>
                    <div class="complete-title"><i class="fa fa-credit-card fa-2x fa-fw"></i><span><?php echo Yii::t('app', 'Chọn phương thức nhận thanh toán')?></span></div>
                    <div class="complete-content">
                        Shareroom có một hệ thống thanh toán bảo mật với nhiều lựa chọn nhận thanh toán dành cho bạn. Ngay bây giờ, hãy thiết lập cách thức nhận thanh toán bạn ưa thích!
                        <p><?php echo CHtml::link(Yii::t('app', 'Cập nhật cách thức nhận thanh toán.'), array('profile/bankinfo')); ?></p>
                    </div>
                </div>
            </div>
		</div>
    </div>
    
    <div class="form-group form-actions">
        <div class="pull-right">
            <?php 
                echo CHtml::link(Yii::t('app', 'Đã xong'), array('profile/dashboard'), array(
                     'class' => 'btn btn-success btn-lg'       
                ));
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
