<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/25/15
 */
echo $this->renderPartial('//profile/_menu_profile');

?>
<div class="profile-box spaces-reservations my_booking">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'filter-status-form',
        'method' => 'get',
        'action' => array('profile/my_booking'),
        'enableAjaxValidation' => false,
    )); ?>
    <!-- Tab panes -->
    <div class="profile-index spaces-index">
        <div class="panel panel-default profile-box message-box">
            <div class="panel-heading box-header">
                <span><?php echo(Yii::t('app', 'Đặt chỗ của tôi.')) ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $form->dropDownList($bookingStatusForm, 'filter_status', array(
                    0 => 'Tất cả',
                    Booking::BOOKING_STATUS_PENDING => 'Đang chờ',
                    2 => 'Đã xong',
                )); ?>
            </div>
            <div class="panel-body">
                <?php if($myBookingModel): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Trạng thái</th>
                                <th>Thanh toán</th>
                                <th>Ngày</th>
                                <th>Vị trí</th>
                                <th>Chủ nhà</th>
                                <th>Giá</th>
<!--                                <th>Lựa chọn</th>-->
                            </tr>
                            <?php foreach($myBookingModel as $data): ?>
                                <?php $ownerInfo = RoomAddress::getOwnerRoom($data->room_address_id); ?>
                                <?php
                                $style_status = '';
                                switch($data->booking_status){
                                    case Booking::BOOKING_STATUS_PENDING:
                                        $style_status = 'pending';
                                        break;
                                    case Booking::BOOKING_STATUS_ACCEPT:
                                        $style_status = 'accept';
                                        break;
                                    case Booking::BOOKING_STATUS_UNACCEPT:
                                        $style_status = 'unaccept';
                                        break;
                                    case Booking::BOOKING_STATUS_USER_CANCEL:
                                        $style_status = 'user_cancel';
                                        break;
                                }
                                ?>
                                <tr>
                                    <td class="status <?php echo($style_status ? $style_status : '') ?>"><?php echo(Booking::_getBookingStatus($data->booking_status)) ?></td>
                                    <td class="status"><?php echo(Booking::_getStatus($data->payment_status)) ?></td>
                                    <td class="date"><?php echo($data->check_in .' '. Constant::getTimeCheck($data->time_check_in) . ' <br> ' . $data->check_out .' '. Constant::getTimeCheck($data->time_check_out)) ?></td>
                                    <td class="room">
                                        <img src="<?php echo RoomImages::getImageByRoomaddress($data->room_address_id)?>"
                                             class="image-medium">
                                        <div class="room-info">
                                            <?php echo CHtml::link($data->BookingHistory->room_name, array('rooms/view', 'id'=>$data->room_address_id)) ?>
                                            <p><?php echo($data->BookingHistory->room_address_detail) ?></p>
                                        </div>

                                    </td>
                                    <td class="user">
                                        <img src="<?php echo $this->createAbsoluteUrl('profile/image', array('id'=>$ownerInfo->id))?>" class="image-small">
                                        <div class="user-info">
                                            <?php echo CHtml::link($ownerInfo->first_name.' '.$ownerInfo->last_name,
                                                array('profile/show', 'id'=>$ownerInfo->id)) ?>
                                        </div>

                                    </td>
                                    <td class="price"><?php echo number_format($data->total_amount) ?> VND</td>
                                    <!--<td>
                                        <?php /*if($data->booking_status == Booking::BOOKING_STATUS_PENDING) : */?>
                                            <?php /*echo CHtml::link('<i class="fa fa-times-circle fa-lg unaccept"></i>', 'javascript:void(0)', array(
                                                'title'=>'Hủy',
                                                'class' => 'unaccept',
                                                'data-id' => $data->id
                                            )) */?>
                                        <?php /*endif */?>
                                    </td>-->
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php else: ?>
                    <div>Không có yêu cầu nào.</div>
                <?php endif ?>
            </div>

        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            /*============== Filter status =================*/
            jQuery('#BookingStatusForm_filter_status').on('change', function() {
                jQuery('form#filter-status-form').submit();
            });

        });
    </script>
<?php Yii::app()->clientScript->endScript();?>