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
                <span><?php echo(Yii::t('app', 'Quản lý bài đăng')) ?></span>
            </div>
            <div class="panel-body">
                <div class="explain">
                </div>

            </div>
        </div>
    </div>

</div>

