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


            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>

</div>

<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery(".date-picker").keyup(function(e) {
                if(e.keyCode == 46) {
                    jQuery.datepicker._clearDate(this);
                }
            });

            jQuery(".delete-picker").click(function() {
                var element = jQuery(this).parent().find(".date-picker");
                jQuery.datepicker._clearDate(element);
            });
        });
    </script>
<?php Yii::app()->clientScript->endScript();?>