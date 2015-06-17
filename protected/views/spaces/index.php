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

    <!-- Tab panes -->
    <div class="profile-index spaces-index">
        <?php if ($listRoomModel): ?>
            <?php foreach ($listRoomModel as $data): ?>
                <div class="item-<?php echo($data->id) ?> item row">
                    <div class="col-md-2 spaces-info">
                        this is an image
                    </div>
                    <div class="col-md-10 calendar-detail">
                        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'name'=>'inline_datepicker',
                                'language'=>'vi',
                                'flat' => true, // tells the widget to show the calendar inline
                                //'showAnim'=>'slide',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                                'options' => array(
                                    //'yearRange' => date('Y-m-d').':' .date('Y-m-d', strtotime('+1 years')),
                                    'numberOfMonths'=>3,
                                    'autoSize'=>true,
                                    'minDate'=>0,
                                    'maxDate'=>"+1Y",
                                    'dateFormat' => 'yy-mm-dd',
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

