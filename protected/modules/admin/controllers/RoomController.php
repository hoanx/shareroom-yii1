<?php

class RoomController extends AdminController
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
	    $this->setPageTitle(Yii::t('app', 'Xem chi tiết phòng cho thuê'));
	    
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

        $paymentForm = new PaymentForm();
        $paymentForm->room_address_id = $room->id;
        $paymentForm->min_night = $room->RoomPrice->min_nights;
        $paymentForm->max_night = $room->RoomPrice->max_nights;

        if(isset($_POST['PaymentForm']) && $_POST['PaymentForm']){
            $paymentForm->attributes = $_POST['PaymentForm'];

            if(!Yii::app()->user->id) {
                $this->redirect(array('site/signin'));
            }

            if($paymentForm->validate()){
                if(Yii::app()->user->hasState('paymentData')){
                    Yii::app()->user->__unset('paymentData');
                }
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
        
        $wishlist = Wishlist::model()->findByAttributes(array('room_address_id' => $id, 'user_id' => Yii::app()->user->id));

        $this->render('view', array(
            'room' => $room,
            'paymentForm' => $paymentForm,
            'listGuest' => $listGuest,
            'wishlist' => $wishlist
        ));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
	    $referer = Yii::app()->request->urlReferrer;
        $model=$this->loadModel($id);
        $model->del_flg = Constant::DEL_TRUE;
        $model->save(false);
        $this->redirect($referer);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $this->setPageTitle(Yii::t('app', 'Danh sách phòng cho thuê'));
        $model=new RoomAddress('search');
        $model->unsetAttributes();  // clear any default values

        if (!empty($_GET['Search'])) {
            $model->attributes = $_GET['RoomAddress'];
        } elseif (!empty($_GET['SearchAdv']) && !empty($_GET['RoomAddress']['Search'])) {
            $model->attributes = $_GET['RoomAddress']['Search'];
        }

        $this->render('index',array(
            'model'=>$model,
        ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Admin the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RoomAddress::model()->findByPk($id, 'del_flg=0');
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}
