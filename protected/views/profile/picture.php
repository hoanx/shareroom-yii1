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
                        <div id="upload-picture" class="upload-picture" style="height: 100%;">

                            <form id="frm_avatar_upload" action="<?php echo Yii::app()->createUrl("profile/upload") ?>" method="post"
                                  enctype="multipart/form-data">
                                <label for="avatar-file" id="label-upload">
                                <p class="text-center"><i class="fa fa-camera-retro fa-5x"></i></p>
                                <p class="text-center">Upload hình ảnh ở đây</p>
                                <p class="text-center">Ảnh không được nặng quá 4MB với kích thước chuẩn là 400pixels x 400 pixels</p>

                                <input id="avatar-file" name="avatar-file" type="file" value="" style="display: none;"/>
                                </label>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
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

            jQuery(document).on('change', '#avatar-file', function () {
                var ext = $('#avatar-file').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
                    alert('Hãy chọn các ảnh có định dạng png, jpg hoặc jpeg.');
                    return false;
                }

                jQuery('form#frm_avatar_upload').submit();
                console.log('form');
            });

        });
    </script>
<?php Yii::app()->clientScript->endScript();?>