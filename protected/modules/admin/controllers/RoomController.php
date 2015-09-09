<?php

class RoomController extends AdminController
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Admin;
        $model->setScenario('register');
        $model->password = Common::generatePassword();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Admin']))
		{
			$model->attributes=$_POST['Admin'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Admin']))
		{
			$model->attributes=$_POST['Admin'];
            if(empty($model->password))
                unset($model->password);

			if($model->save()){
                Yii::app()->getModule('admin')->user->setFlash('success', 'Lưu thông tin quản trị viên thành công.');
                $this->redirect(array('index'));
            }

		}else{
            unset($model->password);
        }

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $model=$this->loadModel($id);
        $model->del_flg = Constant::DEL_TRUE;
        $model->save(false);
        $this->redirect(array('index'));
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
