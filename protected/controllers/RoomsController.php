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
        
        $model = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0));
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
        
        $room = RoomAddress::model()->findByAttributes(array('id' => $id, 'del_flg' => 0));
        
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
}