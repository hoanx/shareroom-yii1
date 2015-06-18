<?php
/**
 * Created by ACV.HoaNX.
 * Date: 5/21/15
 */

echo $this->renderPartial('//profile/_menu_profile');
?>
<div class="profile-edit spaces-edit">
    <!-- Nav tabs -->
    <?php echo $this->renderPartial('_menu_spaces'); ?>

    <?php Yii::app()->clientScript->beginScript('custom-script'); ?>
    <script type="text/javascript">
        // An array of dates
        var eventDates = {};
        eventDates[ new Date( '06/28/2015' )] = new Date( '06/28/2015' );
        eventDates[ new Date( '07/15/2015' )] = new Date( '07/15/2015' );
        eventDates[ new Date( '07/22/2015' )] = new Date( '07/22/2015' );
        eventDates[ new Date( '08/05/2015' )] = new Date( '08/05/2015' );
    </script>
    <?php Yii::app()->clientScript->endScript(); ?>
    <!-- Tab panes -->
    <div class="profile-index spaces-index">
        <?php if ($listRoomModel): ?>
            <?php foreach ($listRoomModel as $data): ?>
                <div class="item-<?php echo($data->id) ?> item row">
                    <div class="col-md-2 spaces-info">
                        <div class="spaces-image-room">
                            <img src="<?php echo RoomImages::getImageByRoomaddress($data->id)?>" class="img-responsive"
                                 alt="<?php echo $data->name ?>">
                        </div>

                    </div>
                    <div class="col-md-10 calendar-detail">

                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'name' => 'inline_datepicker',
                                'language' => 'vi',
                                'flat' => true, // tells the widget to show the calendar inline
                                //'showAnim'=>'slide',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                                'options' => array(
                                    //'yearRange' => date('Y-m-d').':' .date('Y-m-d', strtotime('+1 years')),
                                    'numberOfMonths' => 3,
                                    'autoSize' => true,
                                    'minDate' => 0,
                                    'maxDate' => "+1Y",
                                    'dateFormat' => 'yy-mm-dd',
                                    'beforeShowDay' => 'js:function( date ) {
                                        console.log(eventDates);
                                        var highlight = eventDates[date];
                                        if( highlight ) {
                                             return [true, "requested"];
                                        } else {
                                             return [true, ""];
                                        }
                                     }',
//                                    'beforeShowDay' => 'js:function(date){return true;}',
                                ),
                            )
                        ); ?>

                        <div class="btn-control pull-right">
                            <?php echo CHtml::link(Yii::t('app', 'Chỉnh sửa bài đăng'),
                                array(
                                    'spaces/editlisting',
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




