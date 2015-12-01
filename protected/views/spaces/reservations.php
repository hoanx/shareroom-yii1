<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */

echo $this->renderPartial('//profile/_menu_profile');
?>
<div class="profile-edit spaces-edit spaces-reservations">

    <!-- Nav tabs -->
    <?php echo $this->renderPartial('_menu_spaces'); ?>

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'filter-status-form',
        'method' => 'get',
        'action' => array('spaces/reservations'),
        'enableAjaxValidation' => false,
    )); ?>
    <!-- Tab panes -->
    <div class="profile-index spaces-index">
        <div class="panel panel-default profile-box message-box">
            <div class="panel-heading box-header">
                <span><?php echo(Yii::t('app', 'Yêu cầu đặt phòng')) ?></span>&nbsp;&nbsp;&nbsp;&nbsp;

                <?php echo $form->dropDownList($bookingStatusForm, 'filter_status', array(
                        0 => 'Tất cả',
                        Booking::BOOKING_STATUS_PENDING => 'Đang chờ',
                        2 => 'Đã xong',
                    )); ?>
            </div>

            <div class="panel-body">
                <?php if($reservationsModel): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-booking">
                        <tr>
                            <th>Trạng thái</th>
<!--                            <th>Thanh toán</th>-->
                            <th>Ngày</th>
                            <th>Vị trí</th>
                            <th style="min-width: 160px">Khách</th>
                            <th>Giá</th>
                            <th>Lựa chọn</th>
                        </tr>
                        <?php foreach($reservationsModel as $data): ?>
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
                                <td class="status <?php echo($style_status ? $style_status : '') ?>">
                                    <?php echo(Booking::_getBookingStatus($data->booking_status)) ?>
                                </td>
<!--                                <td class="status">--><?php //echo(Booking::_getStatus($data->payment_status)) ?><!--</td>-->
                                <td class="date"><?php echo($data->check_in .' '. Constant::getTimeCheck($data->time_check_in)
                                        . ' <br> ' . $data->check_out .' '. Constant::getTimeCheck($data->time_check_out)) ?></td>
                                <td class="room">
                                    <img src="<?php echo RoomImages::getImageByRoomaddress($data->room_address_id)?>"
                                         class="image-medium">
                                    <div class="room-info">
                                        <?php echo CHtml::link($data->BookingHistory->room_name, array('rooms/view', 'id'=>$data->room_address_id)) ?>
                                        <p><?php echo($data->BookingHistory->room_address_detail) ?></p>
                                    </div>

                                </td>
                                <td class="user">
                                    <img src="<?php echo $this->createAbsoluteUrl('profile/image', array('id'=>$data->user_id))?>" class="image-small">
                                    <div class="user-info">
                                        <?php echo CHtml::link($data->BookingUser->first_name.' '.$data->BookingUser->last_name,
                                            array('profile/show', 'id'=>$data->user_id)) ?>
                                    </div>

                                </td>
                                <td class="price"><?php echo number_format($data->total_amount) ?> VND</td>
                                <td style="text-align:center;vertical-align:middle">
                                <?php if($data->booking_status == Booking::BOOKING_STATUS_PENDING) : ?>
                                    <?php echo CHtml::link('<i class="fa fa-check-circle fa-lg"></i>', 'javascript:void(0)', array(
                                        'title'=>'Chấp nhận',
                                        'class' => 'accept',
                                        'data-id' => $data->id
                                    )) ?>
                                    &nbsp;&nbsp;
                                    <?php echo CHtml::link('<i class="fa fa-times-circle fa-lg unaccept"></i>', 'javascript:void(0)', array(
                                        'title'=>'Từ chối',
                                        'class' => 'unaccept',
                                        'data-id' => $data->id
                                    )) ?>
                                <?php endif ?>
                                </td>
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


<!-- Modal -->
<div class="modal fade" id="StatusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'booking-status-form',
                'enableAjaxValidation' => false,
            )); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Thay đổi trạng thái</h4>
            </div>
            <div class="modal-body">
                <?php echo $form->hiddenField($bookingStatusForm, 'booking_id'); ?>
                <div class="form-group">
                    <?php echo $form->labelEx($bookingStatusForm, 'status', array('class' => 'control-label')); ?>
                    <?php echo $form->dropDownList($bookingStatusForm, 'status', array(
                            Booking::BOOKING_STATUS_ACCEPT => 'Chấp nhận',
                            Booking::BOOKING_STATUS_UNACCEPT => 'Từ chối',
                        ),
                        array('class' => 'form-control')); ?>
                    <?php echo $form->error($bookingStatusForm, 'status'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($bookingStatusForm, 'content', array('class' => 'control-label')); ?>
                    <?php echo $form->textArea($bookingStatusForm, 'content', array('class' => 'form-control')); ?>
                    <?php echo $form->error($bookingStatusForm, 'content'); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Thay đổi</button>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            /*============== Click update status =================*/
            jQuery('a.accept').click(function(){
                jQuery("#BookingStatusForm_booking_id").val(jQuery(this).data("id"));
                jQuery("#BookingStatusForm_status").val('<?php echo Booking::BOOKING_STATUS_ACCEPT ?>');
                jQuery('#StatusModal').modal();
            });
            jQuery('a.unaccept').click(function(){
                jQuery("#BookingStatusForm_booking_id").val(jQuery(this).data("id"));
                jQuery("#BookingStatusForm_status").val('<?php echo Booking::BOOKING_STATUS_UNACCEPT ?>');
                jQuery('#StatusModal').modal();
            });

            jQuery('#BookingStatusForm_filter_status').on('change', function() {
                jQuery('form#filter-status-form').submit();
            });

        });
    </script>
<?php Yii::app()->clientScript->endScript();?>