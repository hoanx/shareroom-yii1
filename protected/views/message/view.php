<div class="row" id="list-messages">
    <div class="col-md-9">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        <div class="text-center"><?php echo 'Tin nhắn với ' . $conversation->ToUser->first_name . ' ' . $conversation->ToUser->last_name;?></div>
		        <span class="pull-left" style="margin-top: -20px;">
		            <i class="fa fa-play fa-rotate-180"></i> <?php echo CHtml::link('Trở về hộp tin nhắn', array('message/inbox'))?>
		        </span>
		    </div>
			<div class="panel-body">
			    <?php if(!empty($messages)) : ?>
			        <?php foreach($messages as $message) : ?>
			            <div class="row">
			                <div class="col-sm-2 hidden-xs">
			                    <?php if($message->from_user_id == Yii::app()->user->id) : ?>
			                        <div>
			                            <?php if($message->status_flg == Messages::STATUS_WAITING): ?>
                                            <button type="button" class="btn btn-default btn-block">Đang chờ</button>
                                        <?php elseif($message->status_flg == Messages::STATUS_ACCEPT) : ?>
                                            <button type="button" class="btn btn-success btn-block">Được chấp nhận</button>
                                        <?php elseif($message->status_flg == Messages::STATUS_DENY) : ?>
                                            <button type="button" class="btn btn-danger btn-block">Bị từ chối</button>
                                        <?php endif; ?>
			                        </div>
			                        <div class="" id="img-last-message">
                                        <?php if(!empty($message->Users->profile_picture)) : ?>
                                            <?php echo CHtml::image($message->Users->profile_picture, '', array('class' => 'img-responsive')) ?>
                                        <?php else: ?>
                                            <img src="/profile/image" class="img-responsive">
                                        <?php endif; ?>
                                    </div>
                                    <div class="text-center"><?php echo CHtml::link($message->Users->first_name . ' ' . $message->Users->last_name, array(''));?></div>
                                    <div class="text-center"><?php echo Common::humanTiming(strtotime($message->created)); ?></div>
			                    <?php endif; ?>
			                </div>
			                <div class="col-sm-8">
			                    <div class="panel panel-default">
			                        <?php if($message->message_type == Messages::MESSAGE_BOOKING) : ?>
        		                        <div class="panel-heading pannel-heading-small">
        		                            <div class="row">
        		                                <div class="col-sm-8">
        		                                    <div>
        		                                        <?php $booking = $conversation->Booking; ?>
        		                                        <?php echo CHtml::link($booking->BookingHistory->room_name, array('rooms/view', 'id' => $booking->room_address_id))?>
    		                                            <?php echo ' ở ' . $booking->BookingHistory->room_address_detail ?>
    		                                        </div>
    		                                        <div class="text-small">
                                                        <span><i class="fa fa-calendar-o"></i><?php echo 'Ngày ' . date('d/m/Y' , strtotime($booking->check_in)) . ' - ' . date('d/m/Y' , strtotime($booking->check_out)) ?></span>
                                                        <span><i class="fa fa-moon-o"></i><?php echo floor((strtotime($booking->check_out) - strtotime($booking->check_in))/86400) . ' đêm'  ?></span>
                                                        <span><i class="fa fa-user"></i><?php echo $booking->number_of_guests . ' người'  ?></span>
    		                                        </div>
        		                                </div>
        		                                <div class="col-sm-4" style="text-align: right;">
        		                                    <div class="price"><?php echo number_format($booking->total_amount) . ' VND'?></div>
        		                                    <div class="text-small">Tổng chi phí chuyến đi</div>
        		                                    <div class="text-small">(Không gồm phí dịch vụ)</div>
        		                                </div>
        		                            </div>
        		                        </div>
			                        <?php endif; ?>
			                        <div class="panel-body">
			                            <?php if($message->status_flg == Messages::STATUS_DENY) : ?>
			                                <div class="alert alert-danger">
			                            <?php elseif($message->status_flg == Messages::STATUS_WAITING || $message->status_flg == Messages::STATUS_ACCEPT) : ?>
			                                <div class="alert alert-success">
			                            <?php else: ?>
			                                <div>
			                            <?php endif;?>
			                                    <?php echo $message->content ?>
			                                </div>
			                            
			                        </div>
			                    </div>
			                </div>
			                <div class="col-sm-2 hidden-xs">
			                    <?php if($message->from_user_id != Yii::app()->user->id) : ?>
			                        <div>
			                            <?php if($message->status_flg == Messages::STATUS_WAITING): ?>
                                            <button type="button" class="btn btn-default btn-block">Đang chờ</button>
                                        <?php elseif($message->status_flg == Messages::STATUS_ACCEPT) : ?>
                                            <button type="button" class="btn btn-success btn-block">Được chấp nhận</button>
                                        <?php elseif($message->status_flg == Messages::STATUS_DENY) : ?>
                                            <button type="button" class="btn btn-danger btn-block">Bị từ chối</button>
                                        <?php endif; ?>
			                        </div>
			                        <div class="" id="img-last-message">
                                        <?php if(!empty($message->Users->profile_picture)) : ?>
                                            <?php echo CHtml::image($message->Users->profile_picture, '', array('class' => 'img-responsive')) ?>
                                        <?php else: ?>
                                            <img src="/profile/image" class="img-responsive">
                                        <?php endif; ?>
                                    </div>
                                    <div class="text-center"><?php echo CHtml::link($message->Users->first_name . ' ' . $message->Users->last_name, array(''));?></div>
                                    <div class="text-center"><?php echo Common::humanTiming(strtotime($message->created)); ?></div>
			                    <?php endif; ?>
			                </div>
			            </div>
			            <br>
			        <?php endforeach; ?>
			    <?php endif; ?>
			</div>
			<div class="panel-footer">
			        <?php $form=$this->beginWidget('CActiveForm', array(
                        'htmlOptions' => array(
                            'class' => 'form-horizontal'
                        ),
                
                    )); ?>
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <?php echo $form->textArea($newMessage,'content', array('class'=>'form-control', 'rows' => 5)); ?>
                                    </div>
                                    <div class="col-sm-12 alert-error-form">
                                        <?php echo $form->error($newMessage,'content'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-success btn-block"><?php echo(Yii::t('app', 'Gửi đi')) ?></button>
                            </div>
                        </div>
                    <?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
    <div class="col-md-3 sub-menu-message">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingOne">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Tình trạng Còn trống: </a>
					</h4>
				</div>
				<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					<div class="panel-body">
					    <?php $listDateBooking = Booking::getDateBookingByRoomAddress($conversation->Booking->room_address_id); ?>
					    <?php Yii::app()->clientScript->beginScript('custom-script'); ?>
                        <script type="text/javascript">
                            // An array of dates
                            var eventDates = {};
                            <?php foreach($listDateBooking as $date): ?>
                            eventDates[ new Date( '<?php echo($date) ?>' )] = new Date( '<?php echo($date) ?>' );
                             <?php endforeach ?>
                        </script>
                        <?php Yii::app()->clientScript->endScript(); ?>
					    <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'name' => 'inline_datepicker',
                                'language' => 'vi',
                                'flat' => true, // tells the widget to show the calendar inline
                                //'showAnim'=>'slide',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                                'options' => array(
                                    //'yearRange' => date('Y-m-d').':' .date('Y-m-d', strtotime('+1 years')),
                                    'autoSize' => true,
                                    'minDate' => 0,
                                    'yearRange'=>'1900:+1',
                                    'dateFormat' => 'yy-mm-dd',
                                    'beforeShowDay' => 'js:function( date ) {
                                        var highlight = eventDates[date];
                                        if( highlight ) {
                                             return [true, "requested"];
                                        } else {
                                             return [true, ""];
                                        }
                                     }',
                                ),
                            )
                        ); ?>
                        <div>
                            <br>
                            Liên kết đến căn nhà<br>
                            <input type="text" readonly value="<?php echo Yii::app()->createAbsoluteUrl('rooms/view', array('id' => $booking->room_address_id)) ?>" class="form-control"></input>
                        </div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="headingTwo">
					<h4 class="panel-title">
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> Thông tin cần biết </a>
					</h4>
				</div>
				<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
					<div class="panel-body">
					    <div class="sub-title"><i class="fa fa-envelope-o"></i> Tin nhắn</div>
					    <ul>
					        <li>Vì sự an toàn và bảo vệ cho bạn, tất cả thông tin liên lạc và giao dịch phải được lưu giữ trên trang web.</li>
					        <li>Đừng chia sẻ thông tin liên lạc, những thông tin này sẽ được tự động lọc. Thông tin liên lạc sẽ được chia sẻ một khi yêu cầu đặt phòng được chấp thuận.</li>
					        <li>Cố gắng tiếp tục giao dịch không phải ở trang web có thể dẫn đến đình chỉ tài khoản, theo <a href="#">Điều khoản Dịch vụ chúng tôi</a>.</li>
					    </ul>
                        Xem <a href="#">HỎI ĐÁP</a> để được trợ giúp thêm
					</div>
				</div>
			</div>
		</div>
	</div>
</div>