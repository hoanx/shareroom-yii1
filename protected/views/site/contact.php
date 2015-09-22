<div id="contact-form">
    <h2>Thông tin liên hệ</h2>
    <div class="line-gradient">&nbsp;</div>

    <br>
    <br>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'contact-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
        'htmlOptions' => array(
            'class' => 'form-horizontal'
        ),
    )); ?>
    <div class="row">

        <?php if (Yii::app()->user->hasFlash('contact')): ?>
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo Yii::app()->user->getFlash('contact'); ?>
            </div>
        <?php endif; ?>

        <div class="col-md-8">
            <div class="form-group">
                <?php echo $form->labelEx($model,'name', array('class'=>'col-sm-4 control-label label-left')); ?>
                <div class="col-sm-8">
                    <?php echo $form->textField($model,'name', array('class'=>'form-control', 'placeholder'=>Yii::t('app', 'Nhập họ tên'),)); ?>
                </div>
                <div class="col-sm-offset-4 col-sm-8 alert-error-form">
                    <?php echo $form->error($model,'name'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'email', array('class'=>'col-sm-4 control-label label-left')); ?>
                <div class="col-sm-8">
                    <?php echo $form->textField($model,'email', array('class'=>'form-control', 'placeholder'=>Yii::t('app', 'Nhập email'),)); ?>
                </div>
                <div class="col-sm-offset-4 col-sm-8 alert-error-form">
                    <?php echo $form->error($model,'email'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'address', array('class'=>'col-sm-4 control-label label-left')); ?>
                <div class="col-sm-8">
                    <?php echo $form->textField($model,'address', array('class'=>'form-control', 'placeholder'=>Yii::t('app', 'Nhập địa chỉ'),)); ?>
                </div>
                <div class="col-sm-offset-4 col-sm-8 alert-error-form">
                    <?php echo $form->error($model,'address'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'phone_number', array('class'=>'col-sm-4 control-label label-left')); ?>
                <div class="col-sm-8">
                    <?php echo $form->textField($model,'phone_number', array(
                        'class'=>'form-control',
                        'placeholder'=>Yii::t('app', 'Nhập số điện thoại'),
                    )); ?>
                </div>
                <div class="col-sm-offset-4 col-sm-8 alert-error-form">
                    <?php echo $form->error($model,'phone_number'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'body', array('class'=>'col-sm-4 control-label label-left')); ?>
                <div class="col-sm-8">
                    <?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50, 'class'=>'form-control', 'placeholder'=>Yii::t('app', 'Nhập nội dung'))); ?>
                </div>
                <div class="col-sm-offset-4 col-sm-8 alert-error-form">
                    <?php echo $form->error($model,'body'); ?>
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-sm-offset-4 col-sm-8 pull-left">
                    <button type="submit" class="btn btn-success btn-lg"><?php echo(Yii::t('app', 'Gửi liên hệ')) ?></button>
                </div>
            </div>

        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>