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

            </div>
        </div>
    </div>

</div>

