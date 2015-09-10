<style>
table.table-striped th {
    text-align: right;
    width: 160px;
}
table.table-custom th {
    text-align: left;
    width: auto;
}
</style>
<div class="box box-new-room box-price-room">
    <table class="table table-striped">
        <tr>
            <th>Tên người đặt</th>
            <td><?php echo $model->BookingUser->first_name . ' ' .  $model->BookingUser->last_name ?></td>
        </tr>
        <tr>
            <th>Email người đặt</th>
            <td><?php echo $model->BookingUser->email ?></td>
        </tr>
        <tr>
            <th>Số điện thoại người đặt</th>
            <td><?php echo $model->BookingUser->phone_number ?></td>
        </tr>
        <tr>
            <th>Tên phòng</th>
            <td><?php echo $model->BookingHistory->room_name ?></td>
        </tr>
        <tr>
            <th>Địa chỉ phòng</th>
            <td><?php echo $model->BookingHistory->room_address_detail ?></td>
        </tr>
        <tr>
            <th>Ngày đến</th>
            <td><?php echo $model->check_in ?></td>
        </tr>
        <tr>
            <th>Ngày đi</th>
            <td><?php echo $model->check_out ?></td>
        </tr>
        <tr>
            <th>Số khách</th>
            <td><?php echo $model->number_of_guests ?></td>
        </tr>
        <tr>
            <th>Giá tiền một đêm</th>
            <td><?php echo number_format($model->room_price) ?></td>
        </tr>
        <tr>
            <th>Tổng số tiền</th>
            <td><?php echo number_format($model->total_amount) ?></td>
        </tr>
        <tr>
            <th>Phương thức thanh toán</th>
            <td><?php if(!empty($model->payment_method)) echo Booking::_getPaymentMethod($model->payment_method) ?></td>
        </tr>
        <tr>
            <th>Trạng thái thanh toán</th>
            <td><?php if(!empty($model->payment_status)) echo Booking::_getStatus($model->payment_status) ?></td>
        </tr>
        <tr>
            <th>Trạng thái</th>
            <td><?php if(!empty($model->booking_status)) echo Booking::_getBookingStatus($model->booking_status) ?></td>
        </tr>
        <tr>
            <th>Ngày thanh toán</th>
            <td><?php if(!empty($model->invoice_date)) echo date('Y-m-d', strtotime($model->invoice_date)) ?></td>
        </tr>
        <tr>
            <th>Ngày hủy</th>
            <td><?php if(!empty($model->refund_date)) echo date('Y-m-d', strtotime($model->refund_date)) ?></td>
        </tr>
    </table>
</div>
