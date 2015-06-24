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
                    <h4><?php echo $roomModel->name; ?></h4>
                </div>
                <div class="hidden-sm room-address">
                    <p><?php echo $roomModel->address_detail; ?></p>
                </div>
                <hr>

                <table class="table">
                    <tr>
                        <th>Ngày đến</th>
                        <td><?php echo(date('l jS \of F Y', strtotime($paymentData['checkin']))) ?></td>
                    </tr>
                    <tr>
                        <th>Ngày đi</th>
                        <td><?php echo(date('l jS \of F Y', strtotime($paymentData['checkout']))) ?></td>
                    </tr>
                    <tr>
                        <th>Số khách</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Hủy bỏ</th>
                        <td></td>
                    </tr>
                </table>

                <hr>

                <table class="reso-info-table">
                    <tr>
                        <td>Cancellation Policy</td>
                        <td>
                            <a href="https://www.airbnb.com/home/cancellation_policies#strict"
                               class="cancel-policy-link" target="_blank">Strict</a>
                        </td>
                    </tr>
                    <tr>
                        <td>House Rules</td>
                        <td>
                            <a href="#house-rules-modal" class="house-rules-link">Read policy</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nights
                        </td>
                        <td>
                            1
                        </td>
                    </tr>
                    </tbody>
                </table>

                <hr>

                <section id="billing-summary" class="billing-summary">
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
                </section>

            </div>
        </div>

    </div>
    <!--  Cold left  -->
    <div class="col-md-7 col-md-pull-5 col-lg-pull-4">
        <section id="user-info">
            <h2 class="section-title">Xác nhận thông tin đặt phòng</h2>

            <div class="info">
                Họ và tên: .......................<br>
                Địa chỉ: .........................<br>
                Email: ...........................<br>
                SĐT: .............................<br>
            </div>
        </section>

        <section id="payment">
            <h2 class="section-title">Chọn hình thức thanh toán</h2>
        </section>
    </div>

</div>