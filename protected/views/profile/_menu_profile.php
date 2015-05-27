<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/25/15
 */
$controller_name = Yii::app()->controller->id;
$action_name = Yii::app()->controller->action->id;
?>
<div class="profile-menu">
    <ul>
        <?php if ($controller_name == 'profile' && $action_name == 'dashboard'): ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Bảng hoạt động'), array('profile/dashboard'), array('class' => 'btn btn-info active')) ?></li>
        <?php else: ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Bảng hoạt động'), array('profile/dashboard'), array('class' => 'btn btn-info')) ?></li>
        <?php endif; ?>

        <?php if ($controller_name == 'message' && $action_name == 'inbox'): ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Hộp tin nhắn'), array('message/inbox'), array('class' => 'btn btn-info active')) ?></li>
        <?php else: ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Hộp tin nhắn'), array('message/inbox'), array('class' => 'btn btn-info')) ?></li>
        <?php endif; ?>

        <?php if ($controller_name == 'profile' && $action_name == 'my_room'): ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Bài đăng của tôi'), array('profile/my_room'), array('class' => 'btn btn-info active')) ?></li>
        <?php else: ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Bài đăng của tôi'), array('profile/my_room'), array('class' => 'btn btn-info')) ?></li>
        <?php endif; ?>

        <?php if ($controller_name == 'profile' && $action_name == 'my_booking'): ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Đặt chỗ của tôi'), array('profile/my_booking'), array('class' => 'btn btn-info active')) ?></li>
        <?php else: ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Đặt chỗ của tôi'), array('profile/my_booking'), array('class' => 'btn btn-info')) ?></li>
        <?php endif; ?>

        <?php if ($controller_name == 'profile' && $action_name == 'edit'): ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Tài khoản của tôi'), array('profile/edit'), array('class' => 'btn btn-info active')) ?></li>
        <?php else: ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Tài khoản của tôi'), array('profile/edit'), array('class' => 'btn btn-info')) ?></li>
        <?php endif; ?>
    </ul>
</div>