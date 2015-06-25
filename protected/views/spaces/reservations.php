<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */

echo $this->renderPartial('//profile/_menu_profile');
?>
<div class="profile-edit spaces-edit">

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
                    <table class="table">
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
                                <td><?php echo(Booking::_getStatus($data->status_flg)) ?></td>
                                <td><?php echo($data->check_in . ' đến ' . $data->check_out) ?></td>
                                <td><?php echo($data->BookingHistory->room_name) ?></td>
                                <td><?php echo($data->number_of_guests) ?></td>
                                <td><?php echo number_format($data->total_amount) ?> VND</td>
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

