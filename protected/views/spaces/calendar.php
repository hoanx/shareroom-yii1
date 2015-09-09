<?php
echo $this->renderPartial('//profile/_menu_profile');
?>
<?php
Yii::app()->clientScript->coreScriptPosition = CClientScript::POS_END;
Yii::app()->clientScript->registerCoreScript("jquery.ui");
Yii::app()->clientScript->registerCssFile( Yii::app()->clientScript->getCoreScriptUrl(). '/jui/css/base/jquery-ui.css');
?>
<?php Yii::app()->clientScript->beginScript('custom-script'); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
    	var eventDates = {};
        <?php foreach($roomDisable as $date): ?>
            var dateN = new Date( '<?php echo($date->date) ?>' );
            var month = dateN.getUTCMonth();
    		var day = dateN.getUTCDate();
    		var year = dateN.getUTCFullYear();
    		var dateString = year + "-" + month + "-" + day;
    		
            eventDates[dateString] = dateString;
         <?php endforeach ?>
         
    	jQuery(".datepicker").datepicker({
    		dateFormat: "yy-mm-dd",
    		minDate: 0,
			numberOfMonths: [1,1],
			onSelect: function(dateText, inst) {
				var date1 = jQuery.datepicker.parseDate("yy-mm-dd", jQuery("#input1").val());
				var date2 = jQuery.datepicker.parseDate("yy-mm-dd", jQuery("#input2").val());
                var selectedDate = jQuery.datepicker.parseDate("yy-mm-dd", dateText);

                if (!date1 || date2) {
                	jQuery("#input1").val(dateText);
                	jQuery("#input2").val("");
                	jQuery(this).datepicker();
                } else if( selectedDate < date1 ) {
                	jQuery("#input2").val( jQuery("#input1").val() );
                	jQuery("#input1").val( dateText );
                	jQuery(this).datepicker();
                } else {
                	jQuery("#input2").val(dateText);
                	jQuery(this).datepicker();
				}
                
			},
			beforeShowDay: function(date) {
				var date1 = jQuery.datepicker.parseDate("yy-mm-dd", jQuery("#input1").val());
				var date2 = jQuery.datepicker.parseDate("yy-mm-dd", jQuery("#input2").val());
				var dclass = "";

				var month = date.getUTCMonth();
				var day = date.getUTCDate() + 1;
				var year = date.getUTCFullYear();

				var date3 = year + "-" + month + "-" + day;
				var highlight = eventDates[date3];
				
			    if(date1) {
			        if(date.getTime() == date1.getTime()) {
			        	dclass = "dp-highlight";
			        }

			        if(date2) {
			        	if(date.getTime() == date2.getTime()) {
				        	dclass = "dp-highlight";
				        }
				        
			            if((date > date1) && (date < date2)) {
			            	dclass = "dp-highlight";
			            }
			        }
			    }

			    
			    if( highlight ) {
			    	console.log(date);
                    return [true, "requested " + dclass ];
               } else {
                    return [true, dclass];
               }
			},
    	});
    });
</script>
<?php Yii::app()->clientScript->endScript(); ?>

<div class="profile-box spaces-edit">
    <div class="profile-index spaces-index">
        <div>
            <p><?php echo Yii::t('app', 'Cập nhật lịch để bạn chỉ nhận yêu cầu cho thời gian bạn còn trống. Bài đăng với lịch được cập nhật cũng sẽ được ưu tiên trên trang kết quả tìm kiếm. ')?></p>
            <p><?php echo Yii::t('app', 'Để cập nhật, chọn ngày hoặc kéo chuột để chọn nhiều ngày. Chọn trạng thái cho những ngày đó.')?></p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="spaces-calendar">
            	    <div class="datepicker"></div>
            	</div>
            	<div style="margin-top: 20px;">
            	    <div style="display: inline-block; width: 20px; height: 20px; background-color: #ffb584 ;margin-right: 10px;vertical-align: middle;"></div> Đã hết phòng
            	</div>
            </div>
            <div class="col-md-6">
                <?php 
                    $form=$this->beginWidget('CActiveForm', array(
                        'htmlOptions' => array(
                            'class' => 'form-horizontal'
                        ),
                    )); 
                ?>
                <div class="form-group">
                    <label><?php echo $form->labelEx($model,'start_date'); ?></label>
                    <?php echo $form->textField($model,'start_date', array('class'=>'form-control', 'id' => "input1", 'readonly' => true)); ?>
                    <p class="help-block"><?php echo $form->error($model,'start_date'); ?></p>
                </div>
        	    <div class="form-group">
        	        <label><?php echo $form->labelEx($model,'end_date'); ?></label>
                    <?php echo $form->textField($model,'end_date', array('class'=>'form-control', 'id' => "input2", 'readonly' => true)); ?>
                    <p class="help-block"><?php echo $form->error($model,'end_date'); ?></p>
                </div>
                <div class="form-group">
                    <label><?php echo $form->labelEx($model,'status'); ?></label>
                    <?php echo $form->dropdownList($model,'status', RoomSet::statusFlag(), array('class'=>'form-control')); ?>
                    <p class="help-block"><?php echo $form->error($model,'status'); ?></p>
                </div>
                <div class="form-group">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-success btn-lg"><?php echo(Yii::t('app', 'Xác nhận')) ?></button>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
