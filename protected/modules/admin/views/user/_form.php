<?php
/* @var $this UserController */
/* @var $model Users */
/* @var $form CActiveForm */
?>
<section class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'users-form',
        'enableAjaxValidation' => false,
    )); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->textField($model, 'email', array(
                    'size' => 60,
                    'maxlength' => 255,
                    'class' => 'form-control'
                )); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'first_name'); ?>
                <?php echo $form->textField($model, 'first_name', array(
                    'size' => 60,
                    'maxlength' => 255,
                    'class' => 'form-control'
                )); ?>
                <?php echo $form->error($model, 'first_name'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'last_name'); ?>
                <?php echo $form->textField($model, 'last_name', array(
                    'size' => 60,
                    'maxlength' => 255,
                    'class' => 'form-control'
                )); ?>
                <?php echo $form->error($model, 'last_name'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'gender'); ?>
                <?php echo $form->dropDownList($model, 'gender',
                    Users::gender(),
                    array(
                        'class' => 'form-control'
                    )); ?>
                <?php echo $form->error($model, 'gender'); ?>

            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'phone_number'); ?>
                <?php echo $form->textField($model, 'phone_number', array(
                    'size' => 60,
                    'maxlength' => 255,
                    'class' => 'form-control'
                )); ?>
                <?php echo $form->error($model, 'phone_number'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'address'); ?>
                <?php echo $form->textField($model, 'address', array(
                    'size' => 60,
                    'maxlength' => 255,
                    'class' => 'form-control'
                )); ?>
                <?php echo $form->error($model, 'address'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'description', array(
                    'label'=> Yii::t('app', 'Mô tả')
                )); ?>
                <?php echo $form->textArea($model, 'description', array(
                    'rows' => 6,
                    'cols' => 50,
                    'class' => 'form-control'
                )); ?>
                <?php echo $form->error($model, 'description'); ?>
            </div>

            <hr>
            <div class="form-actions">
                <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Tạo mới') : Yii::t('app', 'Cập nhật'),
                array(
                    'class' => 'btn btn-success btn-submit',
                )); ?>
            </div>

        </div>
    </div>

    <?php $this->endWidget(); ?>

</section><!-- form -->