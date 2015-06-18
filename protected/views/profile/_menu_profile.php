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

        <?php if ($controller_name == 'spaces' && $action_name == 'index' || $controller_name=='spaces'): ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Bài đăng của tôi'), array('spaces/index'), array('class' => 'btn btn-info active')) ?></li>
        <?php else: ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Bài đăng của tôi'), array('spaces/index'), array('class' => 'btn btn-info')) ?></li>
        <?php endif; ?>

        <?php if ($controller_name == 'profile' && $action_name == 'my_booking'): ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Đặt chỗ của tôi'), array('profile/my_booking'), array('class' => 'btn btn-info active')) ?></li>
        <?php else: ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Đặt chỗ của tôi'), array('profile/my_booking'), array('class' => 'btn btn-info')) ?></li>
        <?php endif; ?>

        <?php if ($controller_name == 'profile' && ($action_name == 'edit' || $action_name=='picture' || $action_name=='changepass')): ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Tài khoản của tôi'), array('profile/edit'), array('class' => 'btn btn-info active')) ?></li>
        <?php else: ?>
            <li><?php echo CHtml::link(Yii::t('app', 'Tài khoản của tôi'), array('profile/edit'), array('class' => 'btn btn-info')) ?></li>
        <?php endif; ?>
    </ul>

    <?php if($controller_name=='spaces' && !in_array($action_name, array('index', 'reservations', 'policies'))): ?>
    <hr>
    <ul class="sub-link">
        <li><?php echo CHtml::link(Yii::t('app', 'Quản lý bài đăng'), array('spaces/index')) ?></li>
        <li><?php echo CHtml::link(Yii::t('app', 'Yêu cầu đặt chỗ'), array('spaces/reservations')) ?></li>
        <li><?php echo CHtml::link(Yii::t('app', 'Chính sách'), array('spaces/policies')) ?></li>
    </ul>




    <?php endif; ?>
</div>