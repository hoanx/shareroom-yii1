<?php
/**
 * Created by HoaNguyen.
 * Date: 5/24/15
 */

class RoomsController extends Controller
{
    protected function beforeAction($event) {
        if(!Yii::app()->user->id) {
            $this->redirect(Yii::app()->homeUrl);
        }
        
        return true;
    }
    
    public function actionIndex(){

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
                $this->redirect(array('rooms/image' , 'id' => $model->id));
            }
        }
        $this->render('price',array('model'=>$model));
    }
    
    public function actionImage($id = null) {
        $this->setPageTitle(Yii::t('app', 'Đăng tin cho thuê'));
        
        $room = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0, 'user_id' => Yii::app()->user->id));
        
        if(!$room || $room->user_id != Yii::app()->user->id) {
            Yii::app()->user->setFlash('error', 'Permission denied.');
            $this->redirect(Yii::app()->homeUrl);
        }
        
        $images = RoomImages::model()->findAllByAttributes(array('room_address_id' => $id, 'del_flg' => 0));
        
        $this->render('image', array('room' => $room, 'images' => $images));
    }
    
    public function actionComplete($id = null) {
        $this->setPageTitle(Yii::t('app', 'Đăng tin cho thuê'));
    
        $room = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0, 'user_id' => Yii::app()->user->id));
    
        if(!$room || $room->user_id != Yii::app()->user->id) {
            Yii::app()->user->setFlash('error', 'Permission denied.');
            $this->redirect(Yii::app()->homeUrl);
        }
    
        $image = RoomImages::model()->findByAttributes(array('room_address_id' => $id, 'del_flg' => 0));
        
        $this->render('complete', array('room' => $room, 'image' => $image));
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
}