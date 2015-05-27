<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */

echo $this->renderPartial('_menu_profile');
?>
<div class="profile-edit">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs profile-tabs">
        <li><?php echo CHtml::link(Yii::t('app', 'Thông tin chi tiết'), array('profile/edit')) ?></li>
        <li><?php echo CHtml::link(Yii::t('app', 'Hình ảnh'), array('profile/picture')) ?></li>
        <li class="active"><?php echo CHtml::link(Yii::t('app', 'Đổi mật khẩu'), array('profile/changepass')) ?></li>
    </ul>

    <!-- Tab panes -->
    <div class="profile-index">
        <?php $form=$this->beginWidget('CActiveForm'); ?>
        <div class="panel panel-default profile-box profile-info">
            <div class="panel-heading box-header">
                <span><?php echo(Yii::t('app', 'Đổi mật khẩu')) ?></span>
            </div>
            <div class="panel-body">


            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>

</div>
