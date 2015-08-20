<section class="view-record">
    <div class="row">
        <div class="col-lg-6">
            <?php
            $this->widget('zii.widgets.CDetailView', array(
                'id'=>'view-detail',
                'data'=>$profileModel,
                'attributes'=>array(
                    'username',
                    'email',
                ),
                'htmlOptions'=>array(
                    'class' => 'table table-view',
                ),
            ));
            ?>
        </div>
    </div>
    <br/>
    <br/>
    <div class="row">
        <?php $form=$this->beginWidget('CActiveForm'); ?>
        <div class="col-lg-6">
            <fieldset>
                <legend><?php echo Yii::t('admin', 'Thay đổi mật khẩu') ?></legend>
                <div class="form-group">
                    <?php echo $form->labelEx($changePassModel,'current_pass'); ?>
                    <?php echo $form->passwordField($changePassModel,'current_pass', array('class'=>'form-control')); ?>
                    <?php echo $form->error($changePassModel,'current_pass'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($changePassModel,'new_pass'); ?>
                    <?php echo $form->passwordField($changePassModel,'new_pass', array('class'=>'form-control')); ?>
                    <?php echo $form->error($changePassModel,'new_pass'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($changePassModel,'re_new_pass'); ?>
                    <?php echo $form->passwordField($changePassModel,'re_new_pass', array('class'=>'form-control')); ?>
                    <?php echo $form->error($changePassModel,'re_new_pass'); ?>
                </div>
                <div class="form-actions">
                    <?php echo CHtml::htmlButton(Yii::t('app', 'Thay đổi'), array('type' => 'submit', 'class' => 'btn btn-primary btn-submit'))?>
                </div>
            </fieldset>
        </div>
        <?php $this->endWidget();?>
    </div>
</section>