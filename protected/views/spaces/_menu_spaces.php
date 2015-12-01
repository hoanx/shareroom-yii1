<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/28/15
 */
$controller_name = Yii::app()->controller->id;
$action_name = Yii::app()->controller->action->id;
 ?>
<!-- Nav tabs -->
<ul class="nav nav-tabs profile-tabs">
    <?php if ($controller_name == 'spaces' && $action_name == 'index'): ?>
        <li class="active"><?php echo CHtml::link(Yii::t('app', 'Quản lý bài đăng'), array('spaces/index')) ?></li>
    <?php else: ?>
        <li><?php echo CHtml::link(Yii::t('app', 'Quản lý bài đăng'), array('spaces/index')) ?></li>
    <?php endif; ?>

    <?php if ($controller_name == 'spaces' && $action_name == 'reservations'): ?>
        <li class="active"><?php echo CHtml::link(Yii::t('app', 'Yêu cầu đặt phòng'), array('spaces/reservations')) ?></li>
    <?php else: ?>
        <li><?php echo CHtml::link(Yii::t('app', 'Yêu cầu đặt phòng'), array('spaces/reservations')) ?></li>
    <?php endif; ?>

    <?php if ($controller_name == 'spaces' && $action_name == 'policies'): ?>
        <li class="active"><?php echo CHtml::link(Yii::t('app', 'Chính sách'), array('spaces/policies')) ?></li>
    <?php else: ?>
        <li><?php echo CHtml::link(Yii::t('app', 'Chính sách'), array('spaces/policies')) ?></li>
    <?php endif; ?>

</ul>