<?php if($mobile==0): ?>
<div class="row">
<?php endif?>
    <?php
    $listDateBooking = RoomSet::getDateBookingByRoomAddress($room->id);
    $id_input_checkin = 'InputCheckin' . $mobile;
    $id_input_checkout = 'InputCheckout' . $mobile;
    $id_error = 'msg' . $mobile;
    ?>
    <?php Yii::app()->clientScript->beginScript('custom-script-' . $room->id); ?>
    <script type="text/javascript">
        // An array of dates
        var eventDates_<?php echo($room->id) ?> = {};
        <?php foreach($listDateBooking as $data): ?>
        eventDates_<?php echo($room->id) ?>[ new Date('<?php echo($data) ?>')] = new Date('<?php echo($data) ?>');
        <?php endforeach ?>
    </script>
    <?php Yii::app()->clientScript->endScript(); ?>

    <?php echo $form->hiddenField($paymentForm, 'room_address_id'); ?>
    <?php echo $form->hiddenField($paymentForm, 'number_night'); ?>
    <?php echo $form->hiddenField($paymentForm, 'min_night'); ?>
    <?php echo $form->hiddenField($paymentForm, 'max_night'); ?>
    <div class="col-lg-5 frm-checkin">
        <label>Nhận phòng</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'id' => $id_input_checkin,
            'model' => $paymentForm,
            'language'=>'vi',
            'attribute' => 'checkin',
            'options' => array(
                'minDate' => 0,
                'dateFormat' => 'dd-mm-yy',
                'onSelect' => "js:function(selectedDate) {
                    jQuery('#InputCheckout1').datepicker('option', 'minDate', selectedDate);
                    jQuery('#InputCheckout0').datepicker('option', 'minDate', selectedDate);
                }",
                'beforeShowDay' => 'js:function( date ) {
                    var highlight = eventDates_' . $room->id . '[date];
                    if( highlight ) {
                         return [false, "checked"];
                    } else {
                         return [true, ""];
                    }
                 }',

            ),
            'htmlOptions' => array(
                'class' => 'form-control date-picker ui-datepicker-target',
                'maxlength' => 10,
                'placeholder' => Constant::DATE_FORMAT,
            ),
        ));
        ?>
    </div>

    <div class="col-lg-5 frm-checkout">
        <label>Trả phòng</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'id' => $id_input_checkout,
            'model' => $paymentForm,
            'language'=>'vi',
            'attribute' => 'checkout',
            'options' => array(
                'minDate' => 0,
                'yearRange' => '1900:+1',
                'dateFormat' => 'dd-mm-yy',
                'beforeShowDay' => 'js:function( date ) {
                                var highlight = eventDates_' . $room->id . '[date];
                                if( highlight ) {
                                     return [false, "checked"];
                                } else {
                                     return [true, ""];
                                }
                             }',
                'onSelect' => 'js:function(dateText, inst) {
                    jQuery("#InputCheckin1").datepicker("option", "maxDate", dateText);
                    jQuery("#InputCheckin0").datepicker("option", "maxDate", dateText);
                    var oneDay = 24*60*60*1000;
                    var min_night = jQuery("#PaymentForm_min_night").val();
                    var max_night = jQuery("#PaymentForm_max_night").val();
                    var checkin_date = jQuery("#' . $id_input_checkin . '").val().split("-");
                    var checkout_date = dateText.split("-");

                    var checkin = new Date(checkin_date[2],checkin_date[1],checkin_date[0]);
                    var checkout = new Date(checkout_date[2],checkout_date[1],checkout_date[0]);

                    var diffDays = Math.round(((checkout.getTime() - checkin.getTime())/(oneDay)));

                    jQuery("#PaymentForm_number_night").val(diffDays);

                    if(diffDays > max_night){
                        //loi so dem toi thieu
                        jQuery("#'.$id_error.'").html(\'<div class="alert alert-danger alert-dismissable fade in">Số đêm tối đa \'+max_night+ \' Đêm</div>\');
                    }else{
                        if(diffDays < min_night){
                            //loi so dem toi thieu
                            jQuery("#'.$id_error.'").html(\'<div class="alert alert-danger alert-dismissable fade in">Số đêm tối thiểu \'+min_night+ \' Đêm</div>\');
                        }else{
                            jQuery("#'.$id_error.'").empty();
                        }
                    }

                    console.log(diffDays);
                }',
            ),
            'htmlOptions' => array(
                'class' => 'form-control date-picker ui-datepicker-target',
                'maxlength' => 10,
                'placeholder' => Constant::DATE_FORMAT,
            ),
        ));
        ?>
    </div>
    <div class="col-lg-2 frm-guest">
        <label>Khách</label>
        <?php echo $form->dropdownList($paymentForm, 'number_of_guests', $listGuest, array('class' => 'form-control')); ?>
    </div>
<?php if($mobile==0): ?>
</div>
<?php endif ?>

<div id="msg<?php echo $mobile ?>" style="margin-top: 15px">
    <?php if($paymentForm->hasErrors()): ?>
    <div class="alert alert-danger alert-dismissable fade in">
        <?php
        foreach($paymentForm->getErrors() as $key => $errors){
            foreach($errors as $errAtr){
                echo $errAtr;
            }
        }
        ?>
    </div>
    <?php endif ?>
</div>