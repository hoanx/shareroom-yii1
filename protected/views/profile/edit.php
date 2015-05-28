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
                <span><?php echo(Yii::t('app', 'Thông tin bắt buộc')) ?></span>
            </div>
            <div class="panel-body">
                <div class="form-group row">
                    <?php echo $form->labelEx($usersModel,'first_name', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($usersModel,'first_name', array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($usersModel,'first_name'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?php echo $form->labelEx($usersModel,'last_name', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($usersModel,'last_name', array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($usersModel,'last_name'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?php echo $form->labelEx($usersModel,'email', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($usersModel,'email', array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($usersModel,'email'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?php echo $form->labelEx($usersModel,'phone_number', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($usersModel,'phone_number', array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($usersModel,'phone_number'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?php echo $form->labelEx($usersModel,'description', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textArea($usersModel,'description', array('class'=>'form-control', 'rows' => 6)); ?>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($usersModel,'description'); ?>
                    </div>
                </div>

            </div>
        </div>

        <div class="panel panel-default profile-box profile-info">
            <div class="panel-heading box-header">
                <span><?php echo(Yii::t('app', 'Thông tin tùy chọn')) ?></span>
            </div>
            <div class="panel-body">
                <div class="form-group row">
                    <?php echo $form->labelEx($usersModel,'gender', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->dropDownList($usersModel,'gender', Users::gender(), array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($usersModel,'gender'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?php echo $form->labelEx($usersModel,'birthday', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $usersModel,
                                'attribute' => 'birthday',
                                'options' => array(
                                    'changeMonth'=>'true',
                                    'changeYear'=>'true',
                                    'yearRange'=>'1900:'.date('Y'),
                                    'dateFormat' => 'yy-mm-dd',
                                    'maxDate' => 'js:new Date()',
                                ),
                                'htmlOptions' => array(
                                    'class'=>'form-control date-picker',
                                    'maxlength' => 10,
                                    'readonly' => 'readonly',
                                ),
                            ));
                            ?>
                            <span class="input-group-addon delete-picker">x</span>
                        </div>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($usersModel,'birthday'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?php echo $form->labelEx($usersModel,'address', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-5">
                        <?php echo $form->textField($usersModel,'address', array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-5 alert-error-form">
                        <?php echo $form->error($usersModel,'address'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <?php echo CHtml::button(Yii::t('app', 'Lưu lại'), array(
                'name' => 'submit',
                'type' => 'submit',
                'class' => 'btn btn-success btn-submit btn-lg',
            ))?>
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