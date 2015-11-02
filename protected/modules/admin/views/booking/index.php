<?php
/* @var $this UserController */
/* @var $model Users */
?>
<section class="table-data">
    <?php $this->renderPartial('_search', array(
        'model'=>$model,
    )) ?>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'users-grid',
        'dataProvider' => $model->search(),
        'columns' => array(
            'id',
            array(
                'name'=>'email',
                'value'=>function($data){
                    return $data->BookingUser->email;
                },
            ),
            array(
                'name'=>'room_price',
                'value'=>function($data){
                    return number_format($data->room_price);
                }
            ),
            array(
                'name'=>'name',
                'value'=>function($data){
                    return $data->BookingHistory->room_name;
                }
            ),
            array(
                'name'=>'user_email',
                'value'=>function($data){
                    return $data->RoomAddress->Users->email;
                }
            ),
            array(
                'name'=>'user_phone',
                'value'=>function($data){
                    return $data->RoomAddress->Users->phone_number;
                }
            ),
            array(
                'name'=>'address_detail',
                'value'=>function($data){
                    return $data->BookingHistory->room_address_detail;
                }
            ),
            array(
                'name'=>'total_amount',
                'type'=> 'raw',
                'value'=>function($data){
                    return number_format($data->total_amount);
                }
            ),
            'check_in',
            'check_out',
            'number_of_guests',
            array(
                'name'=>'payment_status',
                'value'=>function($data){
                    return !empty($data->payment_status) ? Booking::_getStatus($data->payment_status) : '';
                }
            ),
            array(
                'name'=>'booking_status',
                'value'=>function($data){
                    return !empty($data->booking_status) ? Booking::_getBookingStatus($data->booking_status) : '';
                }
            ),
            array(
                'class' => 'CButtonColumn',
                'template' => '{view}{delete}',
            ),
        ),
    )); ?>
</section>
