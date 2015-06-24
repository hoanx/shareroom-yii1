<?php echo $form->hiddenField($paymentForm,'room_address_id'); ?>
<div class="col-lg-5 frm-checkin">
    <label>Nhận phòng</label>
    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model' => $paymentForm,
        'attribute' => 'checkin',
        'options' => array(
            'minDate' => 0,
            'dateFormat' => 'dd/mm/yy',
        ),
        'htmlOptions' => array(
            'class'=>'form-control date-picker ui-datepicker-target',
            'maxlength' => 10,
            'placeholder' => Constant::DATE_FORMAT
        ),
    ));
    ?>
</div>

<div class="col-lg-5 frm-checkout">
    <label>Trả phòng</label>
    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model' => $paymentForm,
        'attribute' => 'checkout',
        'options' => array(
            'minDate' => 0,
            'dateFormat' => 'dd/mm/yy',
        ),
        'htmlOptions' => array(
            'class'=>'form-control date-picker ui-datepicker-target',
            'maxlength' => 10,
            'placeholder' => Constant::DATE_FORMAT
        ),
    ));
    ?>
</div>
<div class="col-lg-2 frm-guest">
    <label>Khách</label>
    <?php echo $form->dropdownList($paymentForm,'number_of_guests', $listGuest, array('class'=>'form-control')); ?>
</div>