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
        <li class="active"><a href="#home"><?php echo(Yii::t('app', 'Thông tin chi tiết')) ?></a></li>
        <li><?php echo CHtml::link(Yii::t('app', 'Hình ảnh'), array('profile/picture')) ?></li>
    </ul>

    <!-- Tab panes -->
    <div class="profile-index">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'profile-edit-form',
//            'class'=>'form-horizontal profile-edit-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>
        <div class="panel panel-default profile-box profile-info">
            <div class="panel-heading box-header">
                <span><?php echo(Yii::t('app', 'Thông tin bắt buộc')) ?></span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?php echo $form->textField($usersModel,'first_name', array(
                        'class'=>'form-control',
                        'placeholder' => $usersModel->getAttributeLabel('first_name'),
                        'autofocus' => 'autofocus'
                    )); ?>
                    <?php echo $form->error($usersModel,'first_name', array('class'=>'help-block error-login')); ?>
                </div>

            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>

</div>