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

    <!-- Tab panes -->
    <div class="profile-index spaces-index">
        <div class="panel panel-default profile-box message-box">
            <div class="panel-heading box-header">
                <span><?php echo(Yii::t('app', 'Yêu cầu đặt chỗ')) ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
                <select>
                    <option value="0">Tất cả</option>
                    <option value="1">Đang chờ</option>
                    <option value="3">Đã xong</option>
                </select>
            </div>
            <div class="panel-body">
                <?php if($reservationsModel): ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Trạng thái</th>
                            <th>Ngày</th>
                            <th>Vị trí</th>
                            <th>Khách</th>
                            <th>Giá</th>
                            <th>Lựa chọn</th>
                        </tr>
                        <?php foreach($reservationsModel as $data): ?>
                            <tr>
                                <td class="status"><?php echo(Booking::_getStatus($data->status_flg)) ?></td>
                                <td class="date"><?php echo($data->check_in . ' <br> ' . $data->check_out) ?></td>
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
                                <td></td>
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

</div>

