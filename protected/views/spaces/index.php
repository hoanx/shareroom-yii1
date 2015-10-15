<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */

echo $this->renderPartial('//profile/_menu_profile');
?>

<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $.fn.bootstrapSwitch.defaults.onText = 'Hiện';
        $.fn.bootstrapSwitch.defaults.offText = 'Ẩn';
    });
</script>
<?php Yii::app()->clientScript->endScript(); ?>

<div class="profile-edit spaces-edit">
    <!-- Nav tabs -->
    <?php echo $this->renderPartial('_menu_spaces'); ?>

    <!-- Tab panes -->
    <div class="profile-index spaces-index">
        <?php if ($listRoomModel): ?>
            <?php foreach ($listRoomModel as $data): ?>
                <?php $listDateBooking = RoomSet::getDateBookingByRoomAddress($data->id); ?>
                <?php Yii::app()->clientScript->beginScript('custom-script-'.$data->id); ?>
                <script type="text/javascript">
                    // An array of dates
                    var eventDates_<?php echo($data->id) ?> = {};
                    <?php foreach($listDateBooking as $date): ?>
                    eventDates_<?php echo($data->id) ?>[ new Date( '<?php echo($date) ?>' )] = new Date( '<?php echo($date) ?>' );
                     <?php endforeach ?>

                    jQuery(document).ready(function () {
                        jQuery("[name='status_room_<?php echo($data->id) ?>']").bootstrapSwitch();
                        jQuery('input[name="status_room_<?php echo($data->id) ?>"]').on('switchChange.bootstrapSwitch', function(event, state) {
                            jQuery.ajax({
                                type: "POST",
                                url: '<?php echo(Yii::app()->createAbsoluteUrl('rooms/updatestatus')) ?>',
                                data: {"room_address_id": $(this).val(), "status_fld": state},
                                dataType: 'json',
                                success: function(response){
                                    if(response.hasError){
                                        jQuery('#modal-error-msg').html(response.ErrorMsg);
                                        $('input[name="status_room_<?php echo($data->id) ?>"]').bootstrapSwitch('toggleState', true);
                                        $('#modal-error').modal('show');
                                    }

                                    console.log(response);
                                }

                            });

                        });
                    });
                </script>
                <?php Yii::app()->clientScript->endScript(); ?>

                <div class="item-<?php echo($data->id) ?> item row">
                    <div class="col-md-2 spaces-info">
                        <div class="spaces-image-room">
                            <img src="<?php echo RoomImages::getImageByRoomaddress($data->id)?>" class="img-responsive"
                                   alt="<?php echo $data->name ?>">
                    </div>
                        <div class="change-status">
                            <input type="checkbox" value="<?php echo $data->id ?>" name="status_room_<?php echo($data->id) ?>"
                                <?php echo $data->status_flg ? 'checked' : '' ?>>
                        </div>
                        <b>
                            Giá theo đêm<br>
                            <?php echo isset($data->RoomPrice->price) ? number_format($data->RoomPrice->price) : 0; ?> VND
                        </b>

                    </div>
                    <div class="col-md-10 calendar-detail">

                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'name' => 'inline_datepicker_'.$data->id,
                                'language' => 'vi',
                                'flat' => true, // tells the widget to show the calendar inline
                                //'showAnim'=>'slide',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                                'options' => array(
                                    //'yearRange' => date('Y-m-d').':' .date('Y-m-d', strtotime('+1 years')),
                                    'numberOfMonths' => 3,
                                    'autoSize' => true,
                                    'minDate' => 0,
                                    'yearRange'=>'1900:+1',
                                    'dateFormat' => 'yy-mm-dd',
                                    'beforeShowDay' => 'js:function( date ) {
                                        var highlight = eventDates_'.$data->id.'[date];
                                        if( highlight ) {
                                             return [true, "requested"];
                                        } else {
                                             return [true, ""];
                                        }
                                     }',
                                ),
                            )
                        ); ?>

                        <div class="btn-control pull-right">
                            <?php 
                            echo CHtml::link(Yii::t('app', 'Chỉnh sửa bài đăng'),
                                array(
                                    'spaces/editlisting',
                                    'id' => ($data->id),
                                ),
                                array(
                                    'class' => 'btn btn-default btn-url',
                                    'style' => 'margin-right: 10px;'
                                ));
                            echo CHtml::link(Yii::t('app', 'Sửa lịch'),
                                array(
                                    'spaces/calendar',
                                    'id' => ($data->id),
                                ),
                                array(
                                    'class' => 'btn btn-default btn-url'
                                )); ?>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <p>Không có bài đăng nào</p>
        <?php endif; ?>
    </div>

</div>

<div class="modal fade modal-vertical-centered " id="modal-error" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Lỗi</h4>
            </div>
            <div id="modal-error-msg" class="modal-body">

            </div>
        </div>
    </div>
</div>
