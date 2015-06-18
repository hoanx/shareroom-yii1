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

<div class="box box-new-room box-price-room">
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'room-price-price-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // See class documentation of CActiveForm for details on this,
    // you need to use the performAjaxValidation()-method described there.
    'enableAjaxValidation' => false,
)); ?>

    <?php $this->renderPartial('//rooms/_form_price', array(
        'model' => $model,
        'form' => $form,
    )); ?>

<div class="form-group form-actions">
    <div class="pull-right">
        <?php
        /*echo CHtml::link('<i class="fa fa-play fa-rotate-180"></i>&nbsp;&nbsp;' . Yii::t('app', 'Quay lại'), array('rooms/new', 'id' => $model->room_address_id), array(
            'class' => 'btn btn-success btn-lg'
        ));*/
        ?>
        <?php echo CHtml::button(Yii::t('app', 'Lưu lại'), array(
            'name' => 'submit',
            'type' => 'submit',
            'class' => 'btn btn-success btn-submit btn-lg',
        ))?>
    </div>
    <div class="clearfix"></div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->