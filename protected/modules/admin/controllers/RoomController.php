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
        
        $this->render('view', array(
            'room' => $room,
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

        if (isset($_POST['status_flg']) && isset($_POST['RoomAddressIds']) && $_POST['RoomAddressIds']){
            $stt = $_POST['status_flg'];
            $arrIds = $_POST['RoomAddressIds'];
            $transaction = Yii::app()->db->beginTransaction();
            try {
                foreach($arrIds as $room_id){
                    $roomAddressModel = RoomAddress::model()->findByPk($room_id);
                    $roomAddressModel->status_flg = $stt;
                    $roomAddressModel->save(false);
                }
                $transaction->commit();
            }catch (Exception $e) {
                $transaction->rollback();
            }

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
