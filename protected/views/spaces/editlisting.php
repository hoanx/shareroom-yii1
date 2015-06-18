<?php
/**
 * Created by ACV.HoaNX.
 * Date: 6/17/15
 */

echo $this->renderPartial('//profile/_menu_profile');
echo $this->renderPartial('_step_edit_room', array(
    'step' => 3,
    'model' => $model,
));
?>

<div class="box box-new-room">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'htmlOptions' => array(
            'class' => 'form-horizontal'
        ),

    )); ?>

    <div class="panel panel-default box box-amenities">
        <div class="panel-heading">
            <h4>Thông tin địa phương</h4>
        </div>
        <div class="panel-body">
        <?php $this->renderPartial('//rooms/_form_address_input', array(
            'model' => $model,
            'form' => $form,
        )); ?>
        </div>
    </div>

    <?php $this->renderPartial('//rooms/_form_address_detail', array(
        'model' => $model,
        'form' => $form,
    )); ?>

    <div class="form-group form-actions">
        <div class="pull-right">
            <button type="submit" class="btn btn-success btn-lg"><?php echo(Yii::t('app', 'Lưu lại')) ?></button>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>

