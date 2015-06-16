<?php
/**
 * Created by HoaNguyen.
 * Date: 5/24/15
 */

class RoomsController extends Controller
{
    public function actionIndex(){

    }


    public function actionNew() {
        $this->setPageTitle(Yii::t('app', 'Đăng tin cho thuê'));
        
        if(Yii::app()->user->id) {
            $this->redirect(Yii::app()->homeUrl);
        }

        $model = new RoomAddress();
        
        if(isset($_POST['RoomAddress'])) {
            $model->attributes  = $_POST['RoomAddress'];
            $model->user_id = Yii::app()->user->id;
            
            if($model->validate()) {
                $model->save();
                $this->redirect(array('rooms/price' , 'id' => $model->id));
            } 
        }

        $this->render('new', array(
            'model' => $model,
        ));

    }

    public function actionPrice($id = null) {
        $this->setPageTitle(Yii::t('app', 'Đăng tin cho thuê'));
        
        if(!Yii::app()->user->id) {
            $this->redirect(Yii::app()->homeUrl);
        }
        
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