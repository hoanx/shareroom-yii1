<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */

echo $this->renderPartial('_menu_profile');
?>
<div class="prifile-main row">
    <div class="col-sm-3">
        <div class="profile-box profile-picture">
            <div class="picture">
                <img src="/images/default_avatar.jpg" class="img-responsive">
            </div>
            <div class="profile-name">
                <span>Hòa Nguyễn</span><br>
                <a href="#">Chỉnh sửa trang cá nhân</a>
            </div>

        </div>
        <div class="panel panel-default profile-box profile-link">
            <div class="panel-heading box-header">
                <span><?php echo(Yii::t('app', 'Đường dẫn nhanh')) ?></span>
            </div>
            <div class="panel-body">
                <ul>
                    <li><?php echo(CHtml::link(Yii::t('app', 'Quản lý bài đăng'), '#')) ?></li>
                    <li><?php echo(CHtml::link(Yii::t('app', 'Yêu cầu đặt chỗ'), '#')) ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="panel panel-default profile-box message-box">
            <div class="panel-heading box-header">
                <span><?php echo(Yii::t('app', 'Tin nhắn')) ?></span>
            </div>
            <div class="panel-body">
                Không có tin nhắn nào
                <p class="clearfix"></p>
                <div class="pull-right">
                    <a href="#" class="btn btn-primary"><?php echo(Yii::t('app', 'Đi đến hộp tin nhắn')) ?></a>
                </div>
            </div>
        </div>

    </div>
</div>