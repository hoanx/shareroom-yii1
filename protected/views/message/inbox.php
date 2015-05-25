<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */

echo $this->renderPartial('//profile/_menu_profile');
?>
<div class="panel panel-default profile-box message-box">
    <div class="panel-heading box-header">
        <span><?php echo(Yii::t('app', 'Hộp tin nhắn')) ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
        <select>
            <option value="0">Tất cả tin nhắn</option>
            <option value="1">Tin nhắn đã đọc</option>
            <option value="3">Tin nhắn chưa được trả lời</option>
        </select>
    </div>
    <div class="panel-body message-index">
        Không có tin nhắn nào
    </div>
</div>