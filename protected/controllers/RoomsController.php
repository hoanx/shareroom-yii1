<?php
class RoomsController extends Controller
{
    protected function beforeAction($action) {
        if($action->id == 'view' || $action->id == 'index' || $action->id == 'updateAjax') {
            return parent::beforeAction($action);
        }
        
        if(!Yii::app()->user->id) {
            $this->redirect(Yii::app()->homeUrl);
        }
        
        return parent::beforeAction($action);
    }
    
    public function actionIndex(){

        //Debug encode adpia
        /*$adpia_url = 'http://purchase.adpia.vn/purchase.php?a_id=A100TEST|0000|0000|1|1&m_id=shareroom&mbr_id=shareroom(Mac Ngoc Tuan)&o_cd=#49&p_cd=#715-2&it_cnt=2&sales=300000&c_cd=Booking Shareroom&p_nm=#715&remote_addr=222.254.10.60';
        $code = "00054";
        $pad = "SBz*drMbZeQCuDxpNjqsAImkHaEYoLG7X4163FOf0Ji.Pnh9yRwgWK52tTVlUc8v";
        $adpia_url = ADPia::ap_url_trt($adpia_url, $code, $pad);
        Common::debugdie($adpia_url);*/

        if(!empty($_GET['lat']) && !empty($_GET['long'])) {
            $data = $_GET;
            
            $model = RoomAddress::getRooms($data);
            
            if(Yii::app()->request->isAjaxRequest) {
                if(isset($_GET['show']) && $_GET['show'] == 'map') {
                    echo $this->renderPartial('_search_map', array('model' => $model, 'ajax' => true), true, true);
                } else {
                    echo $this->renderPartial('_search', array('model' => $model), true, true);
                }
            } else {
                $this->render('index', array(
                    'model' => $model,
                ));
            }
            
        } else {
            $this->redirect(Yii::app()->homeUrl);
        }
    }

    public function actionNew($id = null) {
        $this->setPageTitle(Yii::t('app', 'Đăng tin cho thuê'));
        
        $model = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0, 'user_id' => Yii::app()->user->id));
        if($model) {
            $model->amenities = unserialize($model->amenities);
        } else {
            $model = new RoomAddress();
        }
        
        $user = Users::model()->findByAttributes(array('id' => Yii::app()->user->id, 'del_flg' => 0));
        $user->setScenario('updates');
        
        if(isset($_POST['RoomAddress'], $_POST['Users'])) {
            $model->attributes  = $_POST['RoomAddress'];
            $model->user_id = Yii::app()->user->id;
            
            $user->attributes =  $_POST['Users'];
            $modelValidate = $userValidate = false;
            if($model->validate()){
                $modelValidate = true;
            }
            if($user->validate()){
                $userValidate = true;
            }

            if($modelValidate && $userValidate) {
                $model->save();
                $user->save();
                $this->redirect(array('rooms/price' , 'id' => $model->id));
            } 
        }

        $this->render('new', array(
            'model' => $model,
            'user' => $user
        ));

    }

    public function actionPrice($id = null) {
        $this->setPageTitle(Yii::t('app', 'Đăng tin cho thuê'));
        
        $room = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0, 'user_id' => Yii::app()->user->id));
        
        if(!$room) {
            Yii::app()->user->setFlash('error', 'Permission denied.');
            $this->redirect(Yii::app()->homeUrl);
        }
        
        $model = RoomPrice::model()->findByAttributes(array('room_address_id' => $id));
        if(!$model) {
            $model = new RoomPrice;
        }

        $model->cleaning_fees_day = Constant::CLEANING_FEES_PER_BOOKING;
        
        if(isset($_POST['RoomPrice'])) {
            $model->attributes=$_POST['RoomPrice'];
            $model->room_address_id = $id;

            if($model->validate()) {
                $model->save();
                $this->redirect(array('rooms/image' , 'id' => $id));
            }
        }
        $this->render('price',array(
            'model'=>$model,
            'room'=>$room,
        ));
    }
    
    public function actionImage($id = null) {
        $this->setPageTitle(Yii::t('app', 'Đăng tin cho thuê'));
        
        $room = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0, 'user_id' => Yii::app()->user->id));
        
        if(!$room) {
            Yii::app()->user->setFlash('error', 'Permission denied.');
            $this->redirect(Yii::app()->homeUrl);
        }
        
        $images = RoomImages::model()->findAllByAttributes(array('room_address_id' => $id, 'del_flg' => 0));
        
        $this->render('image', array('room' => $room, 'images' => $images));
    }
    
    public function actionComplete($id = null) {
        $this->setPageTitle(Yii::t('app', 'Đăng tin cho thuê'));
    
        $room = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0, 'user_id' => Yii::app()->user->id));
    
        if(!$room) {
            Yii::app()->user->setFlash('error', 'Permission denied.');
            $this->redirect(Yii::app()->homeUrl);
        }
    
        $image = RoomImages::model()->findByAttributes(array('room_address_id' => $id, 'del_flg' => 0));
        
        $this->render('complete', array('room' => $room, 'image' => $image));
    }
    
    public function actionView($id = null) {

        $room = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0));
    
        if(!$room) {
            Yii::app()->user->setFlash('error', 'Invalid record.');
            $this->redirect(Yii::app()->homeUrl);
        }

        $this->setPageTitle(Yii::t('app', $room->name . ' - Shareroom.vn'));
        
        $this->title = $room->name;
        $this->descriptions = $room->address_detail;
        
        $room->amenities = unserialize($room->amenities);
        
        $this->breadcrumbs = array(
            $room->city => '',
            $room->district => '',
        );

        $paymentForm = new PaymentForm();
        $paymentForm->room_address_id = $room->id;
        $paymentForm->min_night = $room->RoomPrice->min_nights;
        $paymentForm->max_night = $room->RoomPrice->max_nights;

        if(isset($_POST['PaymentForm']) && $_POST['PaymentForm']){
            $paymentForm->attributes = $_POST['PaymentForm'];

            if($paymentForm->validate()){
                if(Yii::app()->user->hasState('paymentData')){
                    Yii::app()->user->__unset('paymentData');
                }
                Yii::app()->user->setState('paymentData', $paymentForm->attributes);

                if(!Yii::app()->user->id) {
                    $this->redirect(array(
                        'site/signin',
                        'url_b'=> $this->createAbsoluteUrl('payments/book', array('id'=>$paymentForm->room_address_id))
                    ));
                }

                $this->redirect(array('payments/book', 'id'=>$paymentForm->room_address_id));
            }

        }

        $listGuest = array();
        for($i=1; $i <= $room->accommodates; $i++){
            if(Constant::GUEST_MAX==$i){
                $listGuest[$i] = $i.'+';
            }else{
                $listGuest[$i] = $i;
            }
        }
        
        $wishlist = Wishlist::model()->findByAttributes(array('room_address_id' => $id, 'user_id' => Yii::app()->user->id));

        $this->render('view', array(
            'room' => $room,
            'paymentForm' => $paymentForm,
            'listGuest' => $listGuest,
            'wishlist' => $wishlist
        ));
    }
    
    public function actionUpload() {
        $count = RoomImages::model()->count("room_address_id = :room_address_id AND del_flg = :del_flg", array("room_address_id" => $_POST['id'], ':del_flg' => 0));
        
        if($count > 17) {
            echo json_encode(array('name' => ''));
        } else {
            $tmpImageFolder = $_SERVER['DOCUMENT_ROOT'] . Constant::PATH_UPLOAD_PICTURE;
            
            $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
            $newFileName = microtime(true).'.'.$ext;
            
            $source = $_FILES['file']['tmp_name'];
            $dest = $tmpImageFolder.'/'.$newFileName;
            
            if(move_uploaded_file($source, $dest)) {
                $room = RoomAddress::model()->findByAttributes(array('id' => $_POST['id'], 'del_flg' => 0, 'user_id' => Yii::app()->user->id));
            
                $model = new RoomImages();
                $model->room_address_id = $room->id;
                $model->image_name = $newFileName;
            
                $model->save();
            }
            
            $return = '<div class="col-md-3 col-sm-4"><img src="' . Yii::app()->baseUrl . Constant::PATH_UPLOAD_PICTURE . $newFileName . '" />
                        <a class="delete" href="' . Yii::app()->createUrl("rooms/deleteImage", array('id' => $model->id)) . '" ><i class="fa fa-times fa-2x"></i></a>
                        </div>';
            
            echo json_encode(array('name' => $return));
        }
    }
    
    public function actionDeleteImage($id = null) {
        $image = RoomImages::model()->findByAttributes(array('id' => $id, 'del_flg' => 0));
        $image->del_flg = Constant::DEL_TRUE;
        
        if($image->save()) {
            unlink($tmpImageFolder = $_SERVER['DOCUMENT_ROOT'] . Constant::PATH_UPLOAD_PICTURE . $image->image_name);
        }
        
        echo '1';
    }

    /**
     * Request ajax change status room address
     */
    public function actionUpdatestatus() {
        $result = array();
        $room_address_id = $_POST['room_address_id'];
        $status_flg = $_POST['status_fld'];
        $user_id = Yii::app()->user->id;
        $criteriaRoom = new CDbCriteria();
        $criteriaRoom->compare('del_flg', Constant::DEL_FALSE);
        $criteriaRoom->compare('user_id', $user_id);
        $roomAddModel = RoomAddress::model()->findByPk($room_address_id, $criteriaRoom);
        $roomAddModel->scenario = 'enable_status';

        if($roomAddModel){
            if($status_flg=='true')
                $roomAddModel->status_flg = RoomAddress::STATUS_ENABLE;
            else
                $roomAddModel->status_flg = RoomAddress::STATUS_DISABLE;

            if($roomAddModel->validate()){
                $roomAddModel->save(false);
                $result['hasSuccess'] = 1;
            }else{
                $result['hasError'] = 1;
                $errorsThisModel = '<b>'.Yii::t('app', 'Danh sách của bạn chưa hoạt động. Vui lòng hoàn tất các yêu cầu sau để kích hoạt!').'</b>';
                $errorsThisModel .= '<ul>';
                foreach($roomAddModel->getErrors() as $key => $errors){
                    foreach($errors as $errAtr){
                        $errorsThisModel .= CHtml::tag('li', array(), $errAtr);
                    }
                }
                $errorsThisModel .= '</ul>';

                $result['ErrorMsg'] = $errorsThisModel;
            }

        }else{
            $result['hasError'] = 1;
            $result['ErrorMsg'] = Yii::t('app', 'Bài đăng không tồn tại.');

        }
        echo(json_encode($result));
        Yii::app()->end();
    }
    
    public function actionWishlist() {
        $room_address_id = $_GET['room_address_id'];
        $user_id =  Yii::app()->user->id;
        
        $wishlist = Wishlist::model()->findByAttributes(array('room_address_id' => $room_address_id, 'user_id' => $user_id));
        
        if($wishlist) {
            Wishlist::model()->deleteAll(
                    'room_address_id = :room_address_id AND user_id = :user_id',
                    array(':room_address_id' => $room_address_id, ':user_id' => $user_id)
            );
            
            echo '<i class="fa fa-heart-o"></i> Đưa vào mục yêu thích';
        } else {
            $wishlist = new Wishlist();
            $wishlist->room_address_id = $room_address_id;
            $wishlist->user_id = $user_id;
            $wishlist->save();
            
            echo '<i class="fa fa-heart" style="color: #ff5a5f;"></i> Xóa khỏi mục yêu thích';
        }
    }
}