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
        if($listRoomModel){
            foreach($listRoomModel as $room){
                $listRoomIds[] = $room->id;
            }

            $criteria = new CDbCriteria();
            $criteria->compare('del_flg', Constant::DEL_FALSE);
            $criteria->addInCondition('room_address_id', $listRoomIds);
            $reservationsModel = Booking::model()->findAll($criteria);
        }

        $this->render('reservations', array(
            'reservationsModel' => isset($reservationsModel) ? $reservationsModel : array(),
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
        $this->render('pricing',array('model'=>$model));
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

}
