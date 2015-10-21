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
            $dataRoomType = @unserialize($roomModel->room_type);
            if ($dataRoomType !== false) {
                $roomModel->room_type = $dataRoomType[0];
            }

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

            // check tinh phi don dep theo dieu kien
            if($roomModel->RoomPrice->cleaning_fees_day==Constant::CLEANING_FEES_PER_BOOKING){
                $paymentData['cleaning_fees'] = $roomModel->RoomPrice->cleaning_fees;
            }else{
                $paymentData['cleaning_fees'] = $roomModel->RoomPrice->cleaning_fees * $paymentData['number_night'];
            }

            $paymentData['price_additional_guests'] = 0; // Giá cho mỗi khách thêm
            $paymentData['additional_guests'] = 0; // số khách thêm

            //Check loai phong de tinh tien
            //@todo: Đổi room type thành int (Chỗ chọn loại phòng chỉ chọn được 1 loại)
            if((is_array($roomModel->room_type) && in_array(Constant::ROOM_TYPE_SHARE_ROOM ,array_values($roomModel->room_type)))
                OR (is_string($roomModel->room_type) && $roomModel->room_type==Constant::ROOM_TYPE_SHARE_ROOM)){
                $paymentData['price_night'] = $paymentData['price_night']*$paymentData['number_of_guests'];
                $paymentData['total_amount'] = $paymentData['price_night']+$paymentData['cleaning_fees'];
            }else{
                if($roomModel->RoomPrice->additional_guests &&
                    $paymentData['number_of_guests'] > $roomModel->RoomPrice->guest_per_night ){

                    $paymentData['price_additional_guests'] = $roomModel->RoomPrice->additional_guests*$paymentData['number_night'];
                    $paymentData['additional_guests'] = $paymentData['number_of_guests'] - $roomModel->RoomPrice->guest_per_night;

                }
                $paymentData['total_amount'] = $paymentData['price_night']+$paymentData['cleaning_fees']+
                    ($paymentData['price_additional_guests']);
            }

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

            // save info booking
            $bookingModel = new Booking();
            $bookingModel->user_id = $usersModel->id;
            $bookingModel->room_address_id = $roomModel->id;
            $bookingModel->check_in = $paymentData['checkin'];
            $bookingModel->time_check_in = Constant::getTimeCheck($roomModel->RoomPrice->check_in);
            $bookingModel->check_out = $paymentData['checkout'];
            $bookingModel->time_check_out = Constant::getTimeCheck($roomModel->RoomPrice->check_out);
            $bookingModel->number_of_guests = $paymentData['number_of_guests'];

            $bookingModel->room_price = $paymentData['price'];
            $bookingModel->cleaning_fees = $paymentData['cleaning_fees'];
            $bookingModel->additional_guests = $paymentData['additional_guests'];
            $bookingModel->price_additional_guests = $paymentData['price_additional_guests'];
            $bookingModel->total_amount = $paymentData['total_amount'];

            if(isset($_POST['submit']) && $_POST['submit']=='Sử dụng'){
                $bookingModel->attributes = $_POST['Booking'];
                //$bookingUserModel->attributes = $_POST['BookingUser'];
                if($bookingModel->validate(array('coupon_code'))){
                    if(empty($bookingModel->coupon_code)){
                        $bookingModel->addError('coupon_code', Yii::t('app', "{attribute_name} không được để trống.", array(
                            '{attribute_name}' => $bookingModel->getAttributeLabel('coupon_code')
                        )));
                    }else{
                        $couponMode = Coupon::getCouponByCode($bookingModel->coupon_code);
                        $bookingModel->discount = $couponMode->discount_amount_percent;
                        $bookingModel->total_amount = $bookingModel->total_amount - ($paymentData['price_night']*$bookingModel->discount/100);
                    }

                }

            }elseif(isset($_POST['Booking'], $_POST['BookingUser'])) {
                $bookingModel->attributes = $_POST['Booking'];
                $bookingUserModel->attributes = $_POST['BookingUser'];

                $checkError = true;
                if($bookingModel->validate()){
                    $checkError = false;
                }
                if($bookingUserModel->validate() && $checkError===false){
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
                    $messages->to_user_id = $roomModel->user_id;
                    $messages->content = 'Chúc mừng! Bạn có một yêu cầu đặt chỗ! Vui lòng xem xét kỹ yêu cầu đặt chỗ của bạn. Nếu bạn có bất kỳ thắc mắc nào, hãy gửi tin nhắn cho khách trước khi chấp nhận việc đặt chỗ.';
                    $messages->status_flg = Messages::STATUS_WAITING;
                    $messages->read_flg = 0;
                    $messages->save();
                    
                    $conversation->last_message_id = $messages->id;
                    $conversation->save();

                    if($bookingModel->payment_method==Booking::PAYMENT_METHOD_SMARTLINK){
                        //redirect and process payment smartlink
                        //@todo: change url
                        $this->redirect(array('profile/my_booking', 'booking_id'=>$bookingModel->id));

                    }else{
                        $this->redirect(array('profile/my_booking', 'booking_id'=>$bookingModel->id));
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
            'couponMode' => isset($couponMode) ? $couponMode : array(),
        ));

    }

    public function actionAddCouponCode(){
        $counponModel = new Coupon();
        $counponModel->coupon_code = Coupon::generateCouponCode();
        $data_amount = array('5', '10', '15', '20');
        $k = array_rand($data_amount);
        $counponModel->discount_amount_percent = $data_amount[$k];
        if($counponModel->save()){
            Yii::app()->user->setFlash('success', Yii::t('app', 'Thêm Coupon code thành công! {coupon_code}', array(
                '{coupon_code}' => $counponModel->coupon_code
            )));
        }else{
            Yii::app()->user->setFlash('error', Yii::t('app', 'Thêm Coupon code Lỗi!'));
        }
        $this->redirect(array('profile/dashboard'));
    }
}