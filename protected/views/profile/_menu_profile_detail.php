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
    <?php if ($controller_name == 'profile' && $action_name == 'edit'): ?>
        <li class="active"><?php echo CHtml::link(Yii::t('app', 'Thông tin chi tiết'), array('profile/edit')) ?></li>
    <?php else: ?>
        <li><?php echo CHtml::link(Yii::t('app', 'Thông tin chi tiết'), array('profile/edit')) ?></li>
    <?php endif; ?>

    <?php if ($controller_name == 'profile' && $action_name == 'picture'): ?>
        <li class="active"><?php echo CHtml::link(Yii::t('app', 'Hình ảnh'), array('profile/picture')) ?></li>
    <?php else: ?>
        <li><?php echo CHtml::link(Yii::t('app', 'Hình ảnh'), array('profile/picture')) ?></li>
    <?php endif; ?>

    <?php if ($controller_name == 'profile' && $action_name == 'bankinfo'): ?>
        <li class="active"><?php echo CHtml::link(Yii::t('app', 'Thông tin ngân hàng'), array('profile/bankinfo')) ?></li>
    <?php else: ?>
        <li><?php echo CHtml::link(Yii::t('app', 'Thông tin ngân hàng'), array('profile/bankinfo')) ?></li>
    <?php endif; ?>

    <?php if ($controller_name == 'profile' && $action_name == 'changepass'): ?>
        <li class="active"><?php echo CHtml::link(Yii::t('app', 'Thiết lập'), array('profile/changepass')) ?></li>
    <?php else: ?>
        <li><?php echo CHtml::link(Yii::t('app', 'Thiết lập'), array('profile/changepass')) ?></li>
    <?php endif; ?>
</ul>