<?php
/**
 * Created by ACV.HoaNX.
 * Date: 6/18/15
 */
?>
    <div class="panel panel-default box box-price">
        <div class="panel-heading">
            <h4>Hình ảnh</h4>
        </div>
        <div class="panel-body">
            <p class="text-center"><i class="fa fa-camera-retro fa-3x"></i></p>

            <p class="text-center">Upload hình ảnh ở đây</p>

            <p class="text-center">Bạn phải upload tối thiểu 6 hình. Hãy chọn những hình ảnh đẹp nhất nhé.</p>

            <p class="text-center">Ảnh không được nặng quá 4MB với kích thước chuẩn là 662pixels x 400 pixels</p>

            <form id="upload" action="<?php echo Yii::app()->createUrl("rooms/upload") ?>" method="post"
                  enctype="multipart/form-data">
                <input id="input-file" name="file" type="file" value=""/>
                <input name="id" type="hidden" value="<?php echo $room->id ?>"/>
            </form>
            <div id="preview-image" class="row">
                <?php
                if (!empty($images)) :
                    foreach ($images as $image) :
                        ?>
                        <div class="col-md-3 col-sm-4">
                            <?php echo CHtml::image(Yii::app()->baseUrl . Constant::PATH_UPLOAD_PICTURE . $image->image_name) ?>
                            <a class="delete"
                               href="<?php echo Yii::app()->createUrl("rooms/deleteImage", array('id' => $image->id)) ?>"><i
                                    class="fa fa-times fa-2x"></i></a>
                        </div>
                    <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>

    <div class="se-pre-con"></div>

<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            var src = '<?php echo Yii::app()->baseUrl . Constant::PATH_UPLOAD_PICTURE; ?>';
            jQuery(document).on('change', '#input-file', function () {
                var ext = $('#input-file').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    alert('Hãy chọn các ảnh có định dạng png, jpg, jpeg hoặc gif.');
                    return false;
                }

                uploadFile();
            });

            jQuery(document).on('click', '.delete', function (e) {
                e.preventDefault();
                var parent = jQuery(this).parent();
                jQuery.ajax({
                    url: jQuery(this).attr('href')
                }).done(function (data) {
                    parent.hide();
                });
            });

            function uploadFile() {
            	jQuery('.se-pre-con').show();
                jQuery("#upload").ajaxSubmit({
                    dataType: 'json',
                    success: function (data, statusText, xhr, wrapper) {
                        jQuery('#input-file').val('');
                        if (data.name) {
                            jQuery('#preview-image').append(data.name);
                        }
                    },
                    complete: function(){
                    	jQuery('.se-pre-con').hide();
                    }
                });
            }
        });
    </script>
<?php Yii::app()->clientScript->endScript(); ?>