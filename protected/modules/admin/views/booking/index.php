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
            'check_in',
            'check_out',
            array(
                'name'=>'name',
                'value'=>function($data){
                    return $data->BookingHistory->room_name;
                }
            ),
            array(
                'name'=>'address_detail',
                'value'=>function($data){
                    return $data->BookingHistory->room_address_detail;
                }
            ),
            'number_of_guests',
            array(
                'name'=>'discount',
                'type'=> 'raw',
                'value'=>function($data){
                    if(isset($data->discount)) return number_format($data->discount);
                }
            ),
            array(
                'name'=>'email',
                'value'=>function($data){
                    return $data->BookingUser->email;
                },
            ),
            array(
                'name'=>'phone',
                'value'=>function($data){
                    return $data->BookingUser->phone_number;
                },
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
                'name'=>'total_amount',
                'type'=> 'raw',
                'value'=>function($data){
                    return number_format($data->total_amount);
                }
            ),
            array(
                'name'=>'payment_status',
                'value'=>function($data){
                    return !empty($data->payment_status) ? Booking::_getStatusAdmin($data->payment_status) : '';
                }
            ),
            array(
                'name'=>'booking_status',
                'value'=>function($data){
                    return !empty($data->booking_status) ? Booking::_getBookingStatus($data->booking_status) : '';
                }
            ),
            'note',
            array(
                'class' => 'CButtonColumn',
                'template' => '{view}{delete}',
            ),
        ),
    )); ?>
</section>
