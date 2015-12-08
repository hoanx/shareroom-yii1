<?php

class BookingController extends AdminController
{
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
        $this->setPageTitle(Yii::t('app', 'Danh sách đặt phòng'));
        $model=new Booking('search');
        $model->unsetAttributes();  // clear any default values
        $model->del_flg = 0;

        if (!empty($_GET['Search'])) {
            $model->attributes = $_GET['Booking'];
        } elseif (!empty($_GET['SearchAdv']) && !empty($_GET['Booking']['Search'])) {
            $model->attributes = $_GET['Booking']['Search'];
        }

        $this->render('index',array(
            'model'=>$model,
        ));
	}
	
	public function actionView($id)
	{
	    $this->setPageTitle(Yii::t('app', 'Xem chi tiết đặt phòng'));
	
	    $model = Booking::model()->findByAttributes(array('id' => $id, 'del_flg' => 0));
	
	    if(!$model) {
	        Yii::app()->user->setFlash('error', 'Invalid record.');
	        $this->redirect(Yii::app()->homeUrl);
	    }
	    
	    if(isset($_POST['Booking'])) {
	        $model->attributes  = $_POST['Booking'];

	        if($model->save()) {
	            $this->redirect(array('booking/index'));
	        }
	    }
	
	    $this->render('view', array(
            'model' => $model,
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
		$model = Booking::model()->findByPk($id, 'del_flg=0');
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}
