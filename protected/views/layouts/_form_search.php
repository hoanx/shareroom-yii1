<form class="frm-search row" action="<?php echo Yii::app()->createUrl("rooms/index")  ?>" id="form-search">
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-map-marker"></i>
                <?php echo CHtml::textField('place', isset($_GET['place']) ? $_GET['place'] : null, array('id' => 'place-desc', 'class' => 'form-control input-lg', 'placeholder' => Yii::t('app', 'Điểm đến của bạn')))?>
                <input type="hidden" id="place-lat" name="lat" value="<?php if(isset($_GET['lat'])) echo $_GET['lat']?>">
                <input type="hidden" id="place-long" name="long" value="<?php if(isset($_GET['long'])) echo $_GET['long']?>">
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-calendar"></i>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                        'name'=>'startdate',
                        'language'=>'vi',
                        'value' => isset($_GET['startdate']) ? $_GET['startdate'] : null,
                        'options'=>array(
                            'onSelect' => "js:function(selectedDate) {
                                jQuery('#end_date').datepicker('option', 'minDate', selectedDate);
                            }",
                            'minDate' => 'js:new Date()',
                        ),
                        'htmlOptions'=>array(
                            'class' => 'form-control input-lg',
                            'placeholder' => Yii::t('app', 'Nhận phòng'),
                            'id' => 'start_date'
                        ),
                    ));
                ?>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-calendar"></i>
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                        'name'=>'enddate',
                        'language'=>'vi',
                        'value' => isset($_GET['enddate']) ? $_GET['enddate'] : null,
                        'options'=>array(
                            'onSelect' => "js:function(selectedDate) {
                                jQuery('#start_date').datepicker('option', 'maxDate', selectedDate);
                            }",
                            'minDate' => 'js:new Date()',
                        ),
                        'htmlOptions'=>array(
                            'class' => 'form-control input-lg',
                            'placeholder' => Yii::t('app', 'Trả phòng'),
                            'id' => 'end_date'
                        ),
                    ));
                ?>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <div class="form-group">
            <div class="inner-addon left-addon">
                <i class="fa fa-users"></i>
                <?php echo CHtml::dropDownList('accommodates', isset($_GET['accommodates']) ? $_GET['accommodates'] : null, Constant::listGuests(), array('class' => 'form-control input-lg', 'empty' => Yii::t('app', 'Số khách')))?>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <button id="search-button" class="btn btn-primary btn-block btn-lg"
                type="submit"><?= Yii::t('app', 'Tìm kiếm') ?></button>
    </div>
</form>