<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */
?>
<div class="prifile-main row">
    <div class="col-md-3 col-sm-4">
        <div class="profile-box profile-picture">
            <div class="picture">
                <img src="<?php echo Yii::app()->createUrl('profile/image', array('id'=>$usersModel->id))?>" class="img-responsive">
            </div>
        </div>
        <?php echo CHtml::link(Yii::t('app', 'Liên lạc với tôi'), 'javascript:void(0)', array('class'=>'btn btn-info btn-block')) ?>
    </div>
    <div class="col-md-9 col-sm-8">

    </div>
</div>