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
        $this->render('reservations', array(
//            'model' => $model,
//            'user' => $user
        ));
    }
    public function actionPolicies(){
        $this->render('policies', array(
//            'model' => $model,
//            'user' => $user
        ));
    }
}
