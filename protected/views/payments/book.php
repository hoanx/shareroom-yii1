<?php
/**
 * Created by ACV.HoaNX.
 * Date: 6/23/15
 */
?>

<div class="row payment-page">
    <!-- Col right -->
    <div class="col-md-5 col-md-push-7 col-lg-4 col-lg-push-8 row">
        <div class="panel payments-listing">
            <div class="photo">
                <?php echo CHtml::image(RoomImages::getImageByRoomaddress($roomModel->id), $roomModel->name, array(
                    'class' => 'img-responsive'
                )) ?>
            </div>

            <div class="panel-body">
                <div class="room-name">
                    <h3><?php echo $roomModel->name; ?></h3>
                </div>
                <div class="hidden-sm room-address">
                    <p><?php echo $roomModel->address_detail; ?></p>
                </div>
                <hr>

                <div class="row billing-summary">
                    <div class="col-xs-7">Ngày đến</div>
                    <div class="col-xs-5">
                        <?php echo($paymentData['checkin']) ?>
                        <span class="info"><?php echo $roomModel->RoomPrice->check_in ?></span>
                    </div>

                </div>
                <div class="row billing-summary">


                    <div class="col-xs-7">Ngày đi</div>
                    <div class="col-xs-5">
                        <?php echo($paymentData['checkout']) ?>
                        <span class="info"><?php echo $roomModel->RoomPrice->check_out ?></span>
                    </div>
                </div>
                <div class="row billing-summary">

                    <div class="col-xs-7">Số khách</div>
                    <div class="col-xs-5">
                        <?php echo($paymentData['number_of_guests']) ?>
                    </div>
                </div>
                <div class="row billing-summary">

                    <div class="col-xs-7">Hủy bỏ</div>
                    <div class="col-xs-5">
                        <?php echo CHtml::link(Constant::getCancellationShort($roomModel->RoomPrice->cancellation),
                            array(
                                'site/cancellation_policies',
                            ),
                            array(
                                'target'=>'_blank'
                            )
                        ) ?>
                    </div>
                </div>
                <hr class="clearfix">
                <div class="row billing-summary">
                    <div
                        class="col-xs-7"><?php echo number_format($roomModel->RoomPrice->price) . 'VND x ' . $paymentData['number_night'] ?></div>
                    <div class="col-xs-5"><?php echo number_format($paymentData['price_night']) ?> VND</div>
                </div>

                <div class="row billing-summary">
                    <div class="col-xs-7">Phí dọn dẹp</div>
                    <div class="col-xs-5"><?php echo number_format($paymentData['cleaning_fees']) ?> VND</div>
                </div>

                <hr class="clearfix">

                <div class="row billing-summary total">
                    <div class="col-xs-7">Tổng</div>
                    <div class="col-xs-5"><?php echo number_format($paymentData['total_amount']) ?> VND</div>
                </div>

                <?php /*
                <hr>


                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th></th>
                            <td>
                                <?php echo($paymentData['checkin']) ?>
                                <span class="info"><?php echo $roomModel->RoomPrice->check_in ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Ngày đi</th>
                            <td>
                                <?php echo($paymentData['checkout']) ?>
                                <span class="info"><?php echo $roomModel->RoomPrice->check_out ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Số khách</th>
                            <td><?php echo($paymentData['number_of_guests']) ?></td>
                        </tr>
                        <tr>
                            <th>Hủy bỏ</th>
                            <td></td>
                        </tr>
                    </table>
                </div>

                <hr>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th><?php echo $roomModel->RoomPrice->price.' x '.$paymentData['number_night'] ?></th>
                            <td><?php echo number_format($paymentData['price_night']) ?> VND</td>
                        </tr>
                        <tr>
                            <th>Phí dọn dẹp</th>
                            <td><?php echo number_format($paymentData['cleaning_fees']) ?> VND</td>
                        </tr>
                    </table>
                </div>

                <hr>

                <div class="table-responsive">
                    <table class="table table-total">
                        <tr>
                            <th>Tổng</th>
                            <td><?php echo number_format($paymentData['total_amount']) ?> VND</td>
                        </tr>
                    </table>
                </div>


                <!--<section id="billing-summary" class="billing-summary">
                    <table id="billing-table" class="reso-info-table billing-table">
                        <tr class="base-price">
                            <td class="name">₫1417325 x 1 night
                            </td>
                            <td class="val">
                                ₫1417325
                            </td>
                        </tr>


                        <tr class="service-fee">
                            <td class="name">
                                Service fee
                                <i class="icon icon-question" data-behavior="tooltip"
                                   aria-label="This helps us run our platform and offer services like 24/7 support on your trip."></i>
                            </td>
                            <td class="val">₫174440</td>
                        </tr>
                    </table>

                    <hr>

                    <table id="payment-total-table" class="reso-info-table billing-table">
                        <tbody>
                        <tr class="total">
                            <td class="name"><span class="h3">Total</span></td>
                            <td class="text-special icon-dark-gray"><span class="h3">₫1591765</span></td>
                        </tr>

                        </tbody>
                    </table>
                </section>-->
*/
                ?>
            </div>
        </div>

    </div>
    <!--  Cold left  -->
    <div class="col-md-7 col-md-pull-5 col-lg-pull-4">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'payment-booking-form',
//            'class'=>'form-horizontal profile-edit-form',
//            'enableClientValidation'=>true,
//            'clientOptions'=>array(
//                'validateOnSubmit'=>true,
//            ),
        )); ?>
        <section id="user-info">
            <h3 class="section-title">Xác nhận thông tin đặt phòng</h3>

            <div class="form-group row">
                <?php echo $form->labelEx($usersModel,'first_name', array('class'=>'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($usersModel,'first_name', array('class'=>'form-control')); ?>
                </div>
                <div class="col-sm-5 alert-error-form">
                    <?php echo $form->error($usersModel,'first_name'); ?>
                </div>
            </div>
            <div class="form-group row">
                <?php echo $form->labelEx($usersModel,'last_name', array('class'=>'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($usersModel,'last_name', array('class'=>'form-control')); ?>
                </div>
                <div class="col-sm-5 alert-error-form">
                    <?php echo $form->error($usersModel,'last_name'); ?>
                </div>
            </div>
            <div class="form-group row">
                <?php echo $form->labelEx($usersModel,'address', array('class'=>'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($usersModel,'address', array('class'=>'form-control')); ?>
                </div>
                <div class="col-sm-5 alert-error-form">
                    <?php echo $form->error($usersModel,'address'); ?>
                </div>
            </div>
            <div class="form-group row">
                <?php echo $form->labelEx($usersModel,'email', array('class'=>'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($usersModel,'email', array('class'=>'form-control')); ?>
                </div>
                <div class="col-sm-5 alert-error-form">
                    <?php echo $form->error($usersModel,'email'); ?>
                </div>
            </div>
            <div class="form-group row">
                <?php echo $form->labelEx($usersModel,'phone_number', array('class'=>'col-sm-3 control-label')); ?>
                <div class="col-sm-6">
                    <?php echo $form->textField($usersModel,'phone_number', array('class'=>'form-control')); ?>
                </div>
                <div class="col-sm-5 alert-error-form">
                    <?php echo $form->error($usersModel,'phone_number'); ?>
                </div>
            </div>
        </section>

        <section id="payment">
            <h3 class="section-title">Chọn hình thức thanh toán</h3>

            
        </section>

        <?php $this->endWidget(); ?>
    </div>

</div>