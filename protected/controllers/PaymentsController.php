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
            $paymentData['price_night'] = $paymentData['number_night'] * $roomModel->RoomPrice->price;
            $paymentData['cleaning_fees'] = $roomModel->RoomPrice->cleaning_fees;
            $paymentData['total_amount'] = $paymentData['price_night']+$paymentData['cleaning_fees'];

            //@todo: Thay bang model user dang ky mua thong tin phong nghi
            $user_id = Yii::app()->user->id;
            $usersModel = Users::model()->findByPk($user_id, 'del_flg = 0');

        }else{
            $this->redirect(array('rooms/view', 'id'=>$id));
        }
        $this->render('book', array(
            'roomModel' => $roomModel,
            'paymentData' => $paymentData,
            'usersModel' => $usersModel,
        ));

    }
}