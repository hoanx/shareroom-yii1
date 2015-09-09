<?php 

class DefaultController extends AdminController {
    
    public function actionLogin() {
        $this->layout = '//layouts/login';
        
        if (!Yii::app()->getModule('admin')->user->isGuest) {
            $this->redirect(Yii::app()->getModule('admin')->user->returnUrl);
        }
        
        $model = new AdminLogin;
        // collect user input data
        if (!empty($_POST)) {
            $model->attributes = $_POST['AdminLogin'];
            
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->getModule('admin')->user->returnUrl);
            }
        }
        
        $this->render('login', array('model'=>$model));
    }
    
    public function actionLogout() {
        Yii::app()->getModule('admin')->user->logout(false);
        $this->redirect(Yii::app()->getModule('admin')->user->loginUrl);
    }
    
    public function actionError() {
        $this->pageTitle = Yii::t('admin', 'Ooops! An error has occurred');
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
    
    public function actionIndex() {
        $this->pageTitle = Yii::t('admin', 'Dashboard');
        

        $this->render('index', array(
            )
        );
    }

    public function actionProfile() {
        $this->pageTitle = Yii::t('admin', 'Profile');

        $changePassModel = new ChangePassword();
        $profileModel = Admin::model()->findByPk(Yii::app()->getModule('admin')->user->id, 'del_flg = 0');

        if (isset($_POST['ChangePassword']) && $data = $_POST['ChangePassword']) {
            $changePassModel->password = $profileModel->password;
            $changePassModel->attributes = $data;

            if ($changePassModel->validate()) {
                $profileModel->password = $changePassModel->new_pass;
                if ($profileModel->save()) {
                    Yii::app()->getModule('admin')->user->setFlash('success', Yii::t('admin', 'Thay đổi mật khẩu thành công.'));
                    $this->redirect('profile');
                }
            }else{
                $changePassModel->current_pass = $data['current_pass'];
            }
        }

        $this->render('profile', array(
            'profileModel' => $profileModel,
            'changePassModel' => $changePassModel
        ));
    }

    public function actionLanguage($lang) {
        if (empty($lang) || !in_array($lang, array_keys(Constant::language()))) {
            $lang = Constant::LANGUAGE_ENGLISH;
        }
	    Yii::app()->language = $lang;
	    Yii::app()->getModule('admin')->user->setState('language', $lang);
        
        $this->redirect(Yii::app()->request->urlReferrer);
    }
}