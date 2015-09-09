<?php
/**
 * Created by ACV.HoaNX.
 * Date: 6/17/15
 */

class SpacesController extends Controller
{
    protected function beforeAction($event) {
        if(!Yii::app()->user->id) {
            $this->redirect(Yii::app()->homeUrl);
        }

        return parent::beforeAction($event) ;
    }

    public function actionIndex(){
        $this->setPageTitle(Yii::t('app', 'Quản lý bài đăng'));

        $user_id = Yii::app()->user->id;
        $listRoomModel = RoomAddress::getRoomByUserId($user_id);


        $this->render('index', array(
            'listRoomModel' => $listRoomModel,
        ));
    }

    public function actionReservations(){
        $listRoomIds = array();
        $user_id = Yii::app()->user->id;
        $listRoomModel = RoomAddress::getRoomByUserId($user_id);

        $bookingStatusForm = new BookingStatusForm();
        if(isset($_POST['BookingStatusForm'])){
            $bookingStatusForm->setScenario('update_status');
            $bookingStatusForm->attributes  = $_POST['BookingStatusForm'];
            if($bookingStatusForm->validate()){
                $bookingStatusModel = Booking::model()->findByPk($bookingStatusForm->booking_id, 'del_flg = 0');
                $bookingStatusModel->booking_status = $bookingStatusForm->status;
                $bookingStatusModel->save(false);
                
                $conversation = Conversation::model()->findByAttributes(array('booking_id' => $bookingStatusModel->id));
                
                if($conversation) {
                    $messages = new Messages();
                    $messages->conversation_id = $conversation->id;
                    $messages->message_type = Messages::MESSAGE_BOOKING;
                    $messages->from_user_id = $user_id;
                    $messages->to_user_id = ($conversation->to_id == $user_id) ? $conversation->from_id : $conversation->to_id;
                    $messages->read_flg = 0;
                    
                    if($bookingStatusForm->status == Booking::BOOKING_STATUS_ACCEPT) {
                        $messages->content = 'Chúc mừng! Bạn đã đặt chỗ thành công.';
                        $messages->status_flg = Messages::STATUS_ACCEPT;
                    } else {
                        $messages->content = 'Bạn đã từ chối yêu cầu đặt chỗ.Chúng tôi khuyến khích bạn chấp nhận yêu cầu đặt chỗ nếu bài đăng của bạn còn trống và bạn cảm thấy thoải mái với khách. Trải nghiệm tốt và bài nhận xét tích cực sẽ giúp bạn tăng thứ hạng trên Shareroom.';
                        $messages->status_flg = Messages::STATUS_DENY;
                    }
                    $messages->save();
                    
                    $conversation->last_message_id = $messages->id;
                    $conversation->status_flg = $messages->status_flg;
                    $conversation->save();
                }
            }
        }

        // filter list booking
        if($listRoomModel){
            foreach($listRoomModel as $room){
                $listRoomIds[] = $room->id;
            }

            $criteria = new CDbCriteria();
            $criteria->compare('del_flg', Constant::DEL_FALSE);
            $criteria->addInCondition('room_address_id', $listRoomIds);
            if(isset($_GET['BookingStatusForm']['filter_status'])){
                $bookingStatusForm->filter_status  = $_GET['BookingStatusForm']['filter_status'];
                if($bookingStatusForm->filter_status==Booking::BOOKING_STATUS_PENDING){
                    $criteria->compare('booking_status', $bookingStatusForm->filter_status);
                }elseif($bookingStatusForm->filter_status==2){
                    $criteria->addInCondition('booking_status', array(
                        Booking::BOOKING_STATUS_ACCEPT,
                        Booking::BOOKING_STATUS_UNACCEPT,
                        Booking::BOOKING_STATUS_USER_CANCEL
                    ));
                }
            }
            $reservationsModel = Booking::model()->findAll($criteria);
        }

        $this->render('reservations', array(
            'reservationsModel' => isset($reservationsModel) ? $reservationsModel : array(),
            'bookingStatusForm' => $bookingStatusForm,
        ));
    }
    public function actionPolicies(){
        $this->render('policies', array(
        ));
    }

    public function actionEditlisting($id=null){
        if(is_null($id)) $this->redirect(array('index'));

        $model = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0, 'user_id' => Yii::app()->user->id));

        if(isset($_POST['RoomAddress'])) {
            $model->attributes  = $_POST['RoomAddress'];
            $model->user_id = Yii::app()->user->id;


            if($model->validate()) {
                $model->save();
                //$this->redirect(array('rooms/price' , 'id' => $model->id));
            }
        }

        if($model) {
            $model->room_type = unserialize($model->room_type);
            $model->amenities = unserialize($model->amenities);
        }

        $this->render('editlisting', array(
            'model' => $model,
        ));
    }

    public function actionPricing($id=null){
        if(is_null($id)) $this->redirect(array('index'));

        $this->setPageTitle(Yii::t('app', 'Đăng tin cho thuê'));

        $room = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0, 'user_id' => Yii::app()->user->id));

        if(!$room || $room->user_id != Yii::app()->user->id) {
            Yii::app()->user->setFlash('error', 'Permission denied.');
            $this->redirect(Yii::app()->homeUrl);
        }

        $model = RoomPrice::model()->findByAttributes(array('room_address_id' => $id));
        if(!$model) {
            $model = new RoomPrice;
        }

        if(isset($_POST['RoomPrice'])) {
            $model->attributes=$_POST['RoomPrice'];
            $model->room_address_id = $id;

            if($model->validate()) {
                $model->save();
                //$this->redirect(array('rooms/image' , 'id' => $model->id));
            }
        }
        $this->render('pricing',array(
            'model'=>$model,
            'room'=>$room,
        ));
    }

    public function actionPhotos($id=null){
        if(is_null($id)) $this->redirect(array('index'));

        $room = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0, 'user_id' => Yii::app()->user->id));

        if(!$room || $room->user_id != Yii::app()->user->id) {
            Yii::app()->user->setFlash('error', 'Permission denied.');
            $this->redirect(Yii::app()->homeUrl);
        }

        $images = RoomImages::model()->findAllByAttributes(array('room_address_id' => $id, 'del_flg' => 0));

        $this->render('photos', array('room' => $room, 'images' => $images));

    }
    
    public function actionCalendar ($id=null) {
        $this->setPageTitle(Yii::t('app', 'Quản lý lịch'));
        
        if(is_null($id)) $this->redirect(array('index'));
        
        $room = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0, 'user_id' => Yii::app()->user->id));
        if(!$room || $room->user_id != Yii::app()->user->id) {
            Yii::app()->user->setFlash('error', 'Permission denied.');
            $this->redirect(Yii::app()->homeUrl);
        }
        
        $roomDisable = RoomSet::model()->findAllByAttributes(array('room_address_id' => $id));
        
        $model = new RoomSet();
        
        if(isset($_POST['RoomSet'])) {
            $model->attributes  = $_POST['RoomSet'];
            
            if(!empty($model->start_date)) {
                if($model->status == RoomSet::STATUS_ENABLE) {
                    // Kiểm tra end_date
                    if(!empty($model->end_date)) {
                        // Nếu có end_date thì set khoảng thời gian giữa start_date và end_date
                        $start_date = $model->start_date;
                        $end_date = $model->end_date;
                        
                        while (strtotime($start_date) <= strtotime($end_date)) {
                            $roomSet = RoomSet::model()->findByAttributes(array('room_address_id' => $id, 'date' => $start_date));
                        
                            if($roomSet) {
                                $roomSet->delete();
                            }
                        
                            $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
                        }
                    } else {
                        // Nếu không có end_date thì chỉ set 1 ngày duy nhất
                        $roomSet = RoomSet::model()->findByAttributes(array('room_address_id' => $id, 'date' => $model->start_date));
                        
                        if($roomSet) {
                            $roomSet->delete();
                        }
                    }
                    
                    $this->redirect(array('calendar', 'id' => $id));
                    
                } else if ($model->status == RoomSet::STATUS_DISABLE) {
                    // Kiểm tra end_date
                    if(!empty($model->end_date)) {
                        // Nếu có end_date thì set khoảng thời gian giữa start_date và end_date
                        $start_date = $model->start_date;
                        $end_date = $model->end_date;
                        
                        while (strtotime($start_date) <= strtotime($end_date)) {
                            $roomSet = RoomSet::model()->findByAttributes(array('room_address_id' => $id, 'date' => $start_date));
                            
                            if(!$roomSet) {
                                $roomSet = new RoomSet();
                                $roomSet->room_address_id = $id;
                                $roomSet->date = $start_date;
                            
                                $roomSet->save();
                            }
                            
                            $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));
                        }
                        
                    } else {
                        // Nếu không có end_date thì chỉ set 1 ngày duy nhất
                        $roomSet = RoomSet::model()->findByAttributes(array('room_address_id' => $id, 'date' => $model->start_date));
                        
                        if(!$roomSet) {
                            $roomSet = new RoomSet();
                            $roomSet->room_address_id = $id;
                            $roomSet->date = $model->start_date;
                            
                            $roomSet->save();
                        }
                    }
                    
                    $this->redirect(array('calendar', 'id' => $id));
                } else {
                    // Báo lỗi nếu để trống status
                    $model->addError('status', "Tính sẵn sàng không được để trống.");
                }
            } else {
                $model->addError('start_date', "Ngày không được để trống.");
            }
        }
        
        $this->render('calendar',array(
            'model' => $model, 
            'roomDisable' => $roomDisable
        ));
    }

}
