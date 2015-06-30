<?php
/**
 * Created by HoaNguyen.
 * Date: 6/23/15
 */

class PaymentsController extends Controller
{
    protected function beforeAction($action) {
        if(!Yii::app()->user->id) {
            $this->redirect(Yii::app()->homeUrl);
        }
        
        return parent::beforeAction($action);
    }
    

    /**
     * payment process
     */
    public function actionBook($id = null) {

        if(Yii::app()->user->hasState('paymentData')){
            $paymentData = Yii::app()->user->getState('paymentData');

            $criteria = new CDbCriteria();
            $criteria->compare('del_flg', Constant::DEL_FALSE);
            $roomModel = RoomAddress::model()->findByPk($id, $criteria);
            if(!$roomModel) {
                Yii::app()->user->setFlash('error', 'Invalid record.');
                $this->redirect(Yii::app()->homeUrl);
            }
            $roomModel->amenities = unserialize($roomModel->amenities);

            //process calculate amount by day
            $paymentData['number_night'] = Common::getRangeDate($paymentData['checkin'], $paymentData['checkout']);
            $price = $roomModel->RoomPrice->price;
            if($paymentData['number_night']>=7){ //Gia theo tuan
                $price = $roomModel->RoomPrice->weekly;
            }

            if($paymentData['number_night']>=28){ //Gia theo thang
                $price = $roomModel->RoomPrice->monthly;
            }
            $paymentData['price'] = $price;
            $paymentData['price_night'] = $paymentData['number_night'] * $price;
            $paymentData['cleaning_fees'] = $roomModel->RoomPrice->cleaning_fees;
            $paymentData['total_amount'] = $paymentData['price_night']+$paymentData['cleaning_fees'];

            //get user infomation
            $user_id = Yii::app()->user->id;
            $usersModel = Users::model()->findByPk($user_id, 'del_flg = 0');

            $bookingUserModel = new BookingUser();
            $bookingUserModel->user_id = $usersModel->id;
            $bookingUserModel->email = $usersModel->email;
            $bookingUserModel->first_name = $usersModel->first_name;
            $bookingUserModel->last_name = $usersModel->last_name;
            $bookingUserModel->address = $usersModel->address;
            $bookingUserModel->phone_number = $usersModel->phone_number;

            $bookingModel = new Booking();

            if(isset($_POST['Booking'], $_POST['BookingUser'])) {
                $bookingModel->attributes = $_POST['Booking'];
                $bookingModel->user_id = $usersModel->id;
                $bookingModel->room_address_id = $roomModel->id;
                $bookingModel->check_in = $paymentData['checkin'].' '.Constant::getTimeCheck($roomModel->RoomPrice->check_in);
                $bookingModel->check_out = $paymentData['checkout'].' '.Constant::getTimeCheck($roomModel->RoomPrice->check_out);
                $bookingModel->number_of_guests = $paymentData['number_of_guests'];
                $bookingModel->room_price = $paymentData['price'];
                $bookingModel->cleaning_fees = $paymentData['cleaning_fees'];
                $bookingModel->total_amount = $paymentData['total_amount'];

                $bookingUserModel->attributes = $_POST['BookingUser'];

                $checkError = true;
                if($bookingModel->validate()){
                    $checkError = false;
                }
                if($bookingUserModel->validate()){
                    $checkError = false;
                }

                if($checkError === false){
                    $bookingModel->save(false);
                    $bookingUserModel->booking_id = $bookingModel->id;
                    $bookingUserModel->save(false);
                    //set data booking history (Room)
                    $bookingHistoryModel = new BookingHistory();
                    $bookingHistoryModel->booking_id = $bookingModel->id;
                    $bookingHistoryModel->room_name = $roomModel->name;
                    $bookingHistoryModel->room_address_detail = $roomModel->address_detail;
                    $bookingHistoryModel->room_address = $roomModel->address;
                    $bookingHistoryModel->room_district = $roomModel->district;
                    $bookingHistoryModel->room_city = $roomModel->city;
                    $bookingHistoryModel->room_lat = $roomModel->lat;
                    $bookingHistoryModel->room_long = $roomModel->long;
                    $bookingHistoryModel->save(false);
                    
                    $conversation = new Conversation();
                    $conversation->from_id = $user_id;
                    $conversation->to_id = $roomModel->user_id;
                    $conversation->booking_id = $bookingModel->id;
                    $conversation->status_flg = Messages::STATUS_WAITING;
                    $conversation->save();
                    
                    $messages = new Messages();
                    $messages->conversation_id = $conversation->id;
                    $messages->message_type = Messages::MESSAGE_BOOKING;
                    $messages->from_user_id = $user_id;
                    $messages->content = 'Chúc mừng! Bạn có một yêu cầu đặt chỗ! Vui lòng xem xét kỹ yêu cầu đặt chỗ của bạn. Nếu bạn có bất kỳ thắc mắc nào, hãy gửi tin nhắn cho khách trước khi chấp nhận việc đặt chỗ.';
                    $messages->status_flg = Messages::STATUS_WAITING;
                    $messages->save();
                    
                    $conversation->last_message_id = $messages->id;
                    $conversation->save();

                    if($bookingModel->payment_method==Booking::PAYMENT_METHOD_SMARTLINK){
                        //redirect and process payment smartlink

                    }else{
                        $this->redirect(array('profile/booking', 'booking_id'=>$bookingModel->id));
                    }
                }
            }

        }else{
            $this->redirect(array('rooms/view', 'id'=>$id));
        }
        $this->render('book', array(
            'roomModel' => $roomModel,
            'paymentData' => $paymentData,
            'bookingUserModel' => $bookingUserModel,
            'bookingModel' => $bookingModel,
        ));

    }
}