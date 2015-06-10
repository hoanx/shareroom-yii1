<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */

echo $this->renderPartial('_menu_profile');
?>
<div class="profile-edit">

    <!-- Nav tabs -->
    <?php echo $this->renderPartial('_menu_profile_detail'); ?>

    <!-- Tab panes -->
    <div class="profile-index">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'profile-edit-form',
//            'class'=>'form-horizontal profile-edit-form',
//            'enableClientValidation'=>true,
//            'clientOptions'=>array(
//                'validateOnSubmit'=>true,
//            ),
        )); ?>
        <div class="panel panel-default profile-box profile-info">
            <div class="panel-heading box-header">
                <span><?php echo(Yii::t('app', 'Hình ảnh cá nhân')) ?></span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-picture-detail tcenter">
                            <?php //@todo: check profile picture exits ?>
                            <img src="<?php echo Yii::app()->createUrl('profile/image')?>" class="img-responsive vmid">
                            <?php if(Constant::checkProfilePicture(md5(Yii::app()->user->id))): ?>
                            <a class="remove-picture" href="<?php echo $this->createUrl('profile/removeimage') ?>"></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="upload-picture">

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>

</div>

<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery("a.remove-picture").click(function() {
                if(confirm('<?php echo Yii::t('app', 'Bạn có muốn xóa hình ảnh này không'); ?>')){
                    return true;
                }else{
                    return false;
                }
            });


        });
    </script>
<?php Yii::app()->clientScript->endScript();?>