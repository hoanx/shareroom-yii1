<div class="panel-group filter-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion"
                   href="#collapseOne"><?php echo Yii::t('app', 'Tìm kiếm') ?></a>
            </h4>
        </div>
        <div id="collapseOne"
             class="panel-collapse collapse <?php if (!empty($_GET['Search']) || empty($_GET)) echo 'in' ?>">
            <?php echo CHtml::form(array('booking/index'), 'get') ?>
            <div class="panel-body ">
                <div class="row">
                    <div class="form-group col-md-3">
                        <?php echo CHtml::activeLabel($model, '[Search]keyword') ?>
                        <?php echo CHtml::activeTextField($model, 'keyword', array(
                            'class' => 'form-control inline-block',
                        ))?>
                    </div>
                    <div class="form-group col-md-3">
                        <?php echo CHtml::activeLabel($model, '[Search]start_date') ?>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $model,
                            'attribute' => 'start_date',
                            'language'=>'vi',
                            'options' => array(
                                'showAnim' => 'slideDown',
                                'dateFormat' => 'yy-mm-dd',
                            ),
                            'htmlOptions' => array(
                                'class' => 'form-control',
                            ),
                        ));
                        ?>
                    </div>
                    <div class="form-group col-md-3">
                        <?php echo CHtml::activeLabel($model, '[Search]end_date') ?>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $model,
                            'attribute' => 'end_date',
                            'language'=>'vi',
                            'options' => array(
                                'showAnim' => 'slideDown',
                                'dateFormat' => 'yy-mm-dd',
                            ),
                            'htmlOptions' => array(
                                'class' => 'form-control',
                            ),
                        ));
                        ?>
                    </div>

                    <div class="form-group col-md-3">
                        <label style="color: #ffffff">Tim Kiem</label>
                        <?php echo CHtml::submitButton(Yii::t('app', 'Tìm kiếm'), array(
                            'class' => 'btn btn-default form-control',
                            'name' => 'Search'
                        ))?>
                    </div>
                </div>
                <!--<div class="form-group">
                    <?php /*echo CHtml::submitButton(Yii::t('app', 'Tìm kiếm'), array(
                        'class' => 'btn btn-default pull-right',
                        'name' => 'Search'
                    ))*/?>
                </div>-->
            </div>
            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion"
                   href="#collapseTwo"><?php echo Yii::t('app', 'Tìm kiếm nâng cao') ?></a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse <?php if (!empty($_GET['SearchAdv'])) echo 'in' ?>">
            <?php echo CHtml::form(array('booking/index'), 'get') ?>
            <div class="panel-body">
                <div class="row">
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]id') ?>
                        <?php echo CHtml::activeTextField($model, '[Search]id', array('class' => 'form-control')) ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]email') ?>
                        <?php echo CHtml::activeTextField($model, '[Search]email', array('class' => 'form-control')) ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]name') ?>
                        <?php echo CHtml::activeTextField($model, '[Search]name', array('class' => 'form-control')) ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]address_detail') ?>
                        <?php echo CHtml::activeTextField($model, '[Search]address_detail', array('class' => 'form-control')) ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]start_price') ?>
                        <?php echo CHtml::activeTextField($model, '[Search]start_price', array('class' => 'form-control')) ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]end_price') ?>
                        <?php echo CHtml::activeTextField($model, '[Search]end_price', array('class' => 'form-control')) ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]room_type') ?>
                        <?php echo CHtml::activeDropDownList($model, '[Search]room_type', Constant::getRoomType(), array('class' => 'form-control', 'empty' => '')) ?>
                    </div>
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]payment_status') ?>
                        <?php echo CHtml::activeDropDownList($model, '[Search]payment_status',
                            Booking::_getStatus(),
                            array('class' => 'form-control', 'empty' => ''))?>
                    </div>
                    <div class="form-group col-lg-3">
                        <?php echo CHtml::activeLabel($model, '[Search]booking_status') ?>
                        <?php echo CHtml::activeDropDownList($model, '[Search]booking_status',
                            Booking::_getBookingStatus(),
                            array('class' => 'form-control', 'empty' => ''))?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo CHtml::submitButton(Yii::t('app', 'Tìm kiếm'), array(
                        'class' => 'btn btn-default pull-right',
                        'name' => 'SearchAdv'
                    ))?>
                </div>
            </div>
            <?php echo CHtml::endForm() ?>
        </div>
    </div>
</div>
