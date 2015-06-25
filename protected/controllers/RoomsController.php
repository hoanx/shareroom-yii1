<?php
/**
 * Created by HoaNguyen.
 * Date: 5/24/15
 */

class RoomsController extends Controller
{
    protected function beforeAction($action) {
        if($action->id == 'view' || $action->id == 'index') {
            return parent::beforeAction($action);
        }
        
        if(!Yii::app()->user->id) {
            $this->redirect(Yii::app()->homeUrl);
        }
        
        return parent::beforeAction($action);
    }
    
    public function actionIndex(){
        if(!empty($_GET['lat']) && !empty($_GET['long'])) {
            $data = $_GET;
            
            $earthRadius = '3963.0';
            $latitude = $data['lat'];
            $longitude = $data['long'];
            
            $criteria = new CDbCriteria();
            $criteria->join = 'LEFT JOIN tb_room_price AS roomprice ON t.id = roomprice.room_address_id';
            $criteria->select = "ROUND($earthRadius * ACOS(SIN($latitude*PI()/180) * SIN(t.lat*PI()/180)
                            + COS($latitude*PI()/180) * COS(t.lat*PI()/180 )  *  COS((t.long*PI()/180) - ($longitude*PI()/180) )), 1) as distance, t.*, roomprice.*";
            
            $criteria->condition = 't.del_flg = :del_flg';
            
            if(isset($data['bedrooms']) && $data['bedrooms']) {
                $criteria->condition .= ' AND t.bedrooms = ' . $data['bedrooms'];
            }
            
            if(isset($data['beds']) && $data['beds']) {
                $criteria->condition .= ' AND t.beds = ' . $data['beds'];
            }
            
            if(isset($data['accommodates']) && $data['accommodates']) {
                $criteria->condition .= ' AND t.accommodates >= ' . $data['accommodates'];
            }
            
            if(isset($data['price']) && $data['price']) {
                $prices = explode(",", $data['price']);
                $criteria->condition .= ' AND roomprice.price >= ' . $prices[0] . ' AND roomprice.price <= ' . $prices[1];
            }
            
            if(isset($data['room_type']) && $data['room_type']) {
                $types = explode(",", $data['room_type']);
                $query_parts = array();
                foreach($types as $type) {
                    $query_parts[] = "'%".mysql_real_escape_string($type)."%'";
                }
                
                $string = implode(' OR t.room_type LIKE ', $query_parts);
                
                $criteria->condition .= ' AND (t.room_type LIKE ' . $string . ') ';
            }
            
            if(isset($data['amenities']) && $data['amenities']) {
                $amenities = explode(",", $data['amenities']);
                $query_parts = array();
                foreach($amenities as $amenitie) {
                    $query_parts[] = "'%".mysql_real_escape_string($amenitie)."%'";
                }
            
                $string = implode(' OR t.amenities LIKE ', $query_parts);
            
                $criteria->condition .= ' AND (t.amenities LIKE ' . $string  . ') ';
            }

            
            $criteria->params = array(
                ':del_flg' => Constant::DEL_FALSE,
            );
            
            if(isset($_GET['sort'])) {
                $criteria->order = 'distance ASC, roomprice.price ASC';
            } else {
                $criteria->order = 'distance ASC';
            }

            $model = RoomAddress::model()->findAll($criteria);
            
            $this->render('index', array(
                'model' => $model,
            ));
            
        }

    }


    public function actionNew($id = null) {
        $this->setPageTitle(Yii::t('app', 'Đăng tin cho thuê'));
        
        $model = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0, 'user_id' => Yii::app()->user->id));
        if($model) {
            $model->room_type = unserialize($model->room_type);
            $model->amenities = unserialize($model->amenities);
        } else {
            $model = new RoomAddress();
        }
        
        $user = Users::model()->findByAttributes(array('id' => Yii::app()->user->id, 'del_flg' => 0));
        
        if(isset($_POST['RoomAddress'], $_POST['Users'])) {
            $model->attributes  = $_POST['RoomAddress'];
            $model->user_id = Yii::app()->user->id;
            
            $user->attributes =  $_POST['Users'];
            
            if($model->validate() && $user->validate()) {
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
        
        if(isset($_POST['RoomPrice'])) {
            $model->attributes=$_POST['RoomPrice'];
            $model->room_address_id = $id;

            if($model->validate()) {
                $model->save();
                $this->redirect(array('rooms/image' , 'id' => $model->id));
            }
        }
        $this->render('price',array('model'=>$model));
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
        $this->setPageTitle(Yii::t('app', 'Xem địa điểm'));
    
        $room = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0));
    
        if(!$room) {
            Yii::app()->user->setFlash('error', 'Invalid record.');
            $this->redirect(Yii::app()->homeUrl);
        }
        
        $room->amenities = unserialize($room->amenities);
        
        $this->breadcrumbs = array(
            $room->city => '',
            $room->district => '',
        );

        if(Yii::app()->user->hasState('paymentData')){
            Yii::app()->user->__unset('paymentData');
        }

        $paymentForm = new PaymentForm();
        $paymentForm->room_address_id = $room->id;

        if(isset($_POST['PaymentForm']) && $_POST['PaymentForm']){
            $paymentForm->attributes = $_POST['PaymentForm'];
            if($paymentForm->validate()){
                Yii::app()->user->setState('paymentData', $paymentForm->attributes);
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

        $this->render('view', array(
            'room' => $room,
            'paymentForm' => $paymentForm,
            'listGuest' => $listGuest,
        ));
    }
    
    public function actionUpload() {
        $count = RoomImages::model()->count("room_address_id = :room_address_id AND del_flg = :del_flg", array("room_address_id" => $_POST['id'], ':del_flg' => 0));
        
        if($count > 6) {
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
            
            $return = '<div class="col-md-2 col-sm-4"><img src="' . Yii::app()->baseUrl . Constant::PATH_UPLOAD_PICTURE . $newFileName . '" />
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
}