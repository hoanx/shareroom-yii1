<?php

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphUser;

class SiteController extends Controller
{
    public $layout='//layouts/home';

    public $loginFacebookUrl;
    public $loginGplusUrl;

    public $userInfoFacebook = null;
    public $userInfoGPlus = null;
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

    public function beforeAction($action){
        $arrAction = array('signin', 'signup');
        if(in_array($action->id, $arrAction)){

            if(Yii::app()->user->isGuest){
                $this->_initFacebookSDK();
                if(is_null($this->userInfoFacebook)){
                    $this->_initGPlusSDK();
                }
                if(isset($_GET['url_b']) && $_GET['url_b']){
                    Yii::app()->user->setState('back_url', $_GET['url_b']);
                }
            }else{
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        return parent::beforeAction($action);
    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
        $this->setPageTitle(Yii::t('app', 'Liên hệ'));
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
                $subject = 'Liên hệ từ '.$model->name;
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($subject).'?=';
                // To send HTML mail, the Content-type header must be set
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				$headers .= "From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";
                $body = $model->body.'<br>
                    -----------------------------------<br>
                    Họ tên : '.$model->name.'<br>
                    Số điện thoại : '.$model->phone_number.'<br>
                    Địa chỉ : '.$model->address.'<br>';

				mail(Yii::app()->params['adminEmail'],$subject,$body,$headers);
				Yii::app()->user->setFlash('contact', 'Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi sẽ trả lời bạn trong thời gian sớm nhất.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionSignIn($url_b=null)
	{
        $this->pageTitle = Yii::t('app', 'Đăng nhập');
		$model=new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
                if($url_b){
                    $this->redirect($url_b);
                }else{
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            }

		}
		// display the login form
		$this->render('signin',array(
            'model'=>$model,
            'url_b'=>$url_b,
        ));
	}


    /**
     * Displays the sign up page
     */
    public function actionSignUp($url_b=null)
    {
        $this->pageTitle = Yii::t('app', 'Đăng ký');

        $usersModel = new Users('register');
        if(isset($_POST['Users']))
        {
            $usersModel->attributes=$_POST['Users'];
            $password = $usersModel->password;
            if($usersModel->save()){
                $this->_login($usersModel, $password, $url_b);
            }
        }elseif(!is_null($this->userInfoFacebook)){
            if (Yii::app()->user->hasState('back_url')) {
                $bacl_url = Yii::app()->user->getState('back_url');
            }
            $email = $this->userInfoFacebook['email'];
            $user_exists = Users::findByEmail($email);
            if($user_exists){
                $this->_login($user_exists, Constant::DEFAULT_PASSWORD, (isset($bacl_url)?$bacl_url:null));
            }else{
                $userFacebookModel = new Users();
                $userFacebookModel->attributes=$this->userInfoFacebook;
                $userFacebookModel->save();
                if($userFacebookModel->profile_picture){
                    //download profile picture
                    $user_id = $userFacebookModel->id;
                    $pathProfilePicture =  Yii::app()->basePath . '/..' . Constant::PATH_PROFILE_PICTURE.md5($user_id);
                    Common::download_profile_picture($userFacebookModel->profile_picture, $pathProfilePicture);
                }
                $this->_login($userFacebookModel, $userFacebookModel->password, (isset($bacl_url)?$bacl_url:null));
            }
        }elseif(!is_null($this->userInfoGPlus)){
            $email = $this->userInfoGPlus['email'];
            $user_exists = Users::findByEmail($email);
            if (Yii::app()->user->hasState('back_url')) {
                $bacl_url = Yii::app()->user->getState('back_url');
            }
            if($user_exists){
                $this->_login($user_exists, Constant::DEFAULT_PASSWORD, (isset($bacl_url)?$bacl_url:null));
            }else{
                $userGoogleModel = new Users();
                $userGoogleModel->attributes=$this->userInfoGPlus;
                $userGoogleModel->save();
                if($userGoogleModel->profile_picture){
                    //download profile picture
                    $user_id = $userGoogleModel->id;
                    $pathProfilePicture =  Yii::app()->basePath . '/..' . Constant::PATH_PROFILE_PICTURE.md5($user_id);
                    Common::download_profile_picture($userGoogleModel->profile_picture, $pathProfilePicture);
                }

                $this->_login($userGoogleModel, $userGoogleModel->password, (isset($bacl_url)?$bacl_url:null));
            }
        }

        $this->render('signup', array(
            'usersModel' => $usersModel
        ));
    }
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionForgotpass() {
	    $this->pageTitle = Yii::t('app', 'Đặt lại mật khẩu');
	    
	    if(isset($_GET['token'])) {
	        $decrypt = Common::decrypt($_GET['token']);
	        $data = explode(',', $decrypt);
	        $email = $data[0];
	        
	        $user = Users::findByEmail($email);
	        $user->scenario = 'register';
	        $user->password = '';
	        
	        if(isset($_POST['Users'])) {
	            $user->attributes = $_POST['Users'];
	            $password = $user->password;
	            if($user->save()){
	                $this->_login($user, $password);
	            }
	        }
	        
	        $this->render('forgotpass', array(
                'user' => $user
	        ));
	    } else {
	        $this->redirect(Yii::app()->homeUrl);
	    }
	}
	
	public function actionSendforgot() {
	    if(Yii::app()->request->isAjaxRequest) {
	        $data = $_POST;
	        $user = Users::findByEmail($data['email']);
	        if($user) {
	            $content = $this->renderPartial('//template/forgotpass', array('user' => $user), true, true);
	            Common::sendMail($data['email'], 'Yêu cầu đặt lại mật khẩu cho tài khoản Shareroom của bạn', $content);
	            echo 'success';
	        } else {
	            echo 'error';
	        }
	    }
	    die;
	}

    protected function _initFacebookSDK(){
        $app_id = Yii::app()->facebook->appId;
        $app_secret = Yii::app()->facebook->secret;
        $app_version = Yii::app()->facebook->version;
        FacebookSession::setDefaultApplication($app_id, $app_secret);
        $refirect_url = Yii::app()->createAbsoluteUrl('site/signup', array('facebook_code'=>1));
        $helper = new FacebookRedirectLoginHelper($refirect_url);
        try {
            unset( $_SESSION['access_token_facebook'] );
            if ( isset( $_SESSION['access_token_facebook'] ) ) {
                // Check if an access token has already been set.
                $session = new FacebookSession( $_SESSION['access_token_facebook'] );
            } else {
                // Get access token from the code parameter in the URL.
                $session = $helper->getSessionFromRedirect();
            }
        } catch( FacebookRequestException $ex ) {
            // When Facebook returns an error.
            throw $ex;
        } catch( \Exception $ex ) {
            // When validation fails or other local issues.
            throw $ex;
        }

        // If successfully login
        if ( isset( $session ) ) {
            // Retrieve & store the access token in a session.
            $_SESSION['access_token_facebook'] = $session->getToken();
            // Retrieve User’s Profile Information
            $requestFB = new FacebookRequest( $session, 'GET', '/me' );
            $requestProfile = $requestFB->execute();
            $userProfile = $requestProfile->getGraphObject(GraphUser::className())->asArray();

            // Get User’s Profile Picture
            $requestPicFB = new FacebookRequest( $session, 'GET', '/me/picture?type=large&redirect=false' );
            $requestPicture = $requestPicFB->execute();
            $userPicture = $requestPicture->getGraphObject(GraphUser::className())->asArray();
            $gender = 0;
            if(isset($userProfile['gender'])){
                if($userProfile['gender']=='male') $gender = Users::GENDER_MALE;
                if($userProfile['gender']=='female') $gender = Users::GENDER_FEMALE;
            }
            $this->userInfoFacebook = array(
                'facebook_id' => $userProfile['id'],
                'email' => $userProfile['email'],
                'birthday' => isset($userProfile['birthday']) ? date('Y-m-d', strtotime($userProfile['birthday'])) : null,
                'first_name' => $userProfile['first_name'],
                'last_name' => $userProfile['last_name'],
                'profile_picture' => $userPicture['url'],
                'gender' => $gender,
                'password' => Constant::DEFAULT_PASSWORD,
                'description'=>''
            );
        }else{
            $permissions = array(
                'email',
                'user_location',
                'user_birthday'
            );
            $this->loginFacebookUrl = $helper->getLoginUrl($permissions);
        }
    }


    protected function _initGPlusSDK(){
        $client_id = Yii::app()->google->clientId;
        $client_secret = Yii::app()->google->clientSecret;
        $redirect_uri = Yii::app()->createAbsoluteUrl('site/signup');

        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $scope = array(Google_Service_Oauth2::USERINFO_EMAIL, Google_Service_Oauth2::USERINFO_PROFILE);
        $client->addScope($scope);

        if (isset($_GET['code'])) {
            $client->authenticate($_GET['code']);

            $oauth = new Google_Service_Oauth2($client);
            $userInfo = $oauth->userinfo->get();

            $gender = 0;
            if($userInfo->getGender()=='male') $gender = Users::GENDER_MALE;
            if($userInfo->getGender()=='female') $gender = Users::GENDER_FEMALE;

            $this->userInfoGPlus = array(
                'google_id' => $userInfo->id,
                'email' => $userInfo->email,
                'first_name' => $userInfo->familyName,
                'last_name' => $userInfo->givenName,
                'profile_picture' => $userInfo->picture,
                'gender' => $gender,
                'password' => Constant::DEFAULT_PASSWORD,
                'description'=>''
            );
        }
        $this->loginGplusUrl = $client->createAuthUrl();
    }

    /**
     * Set login after signup
     *
     * @param object $usersModel
     * @param string $password
     */
    protected function _login($usersModel, $password, $url_b=null){
        //Set login
        $_identity = new UserIdentity($usersModel->email, $password);
        $_identity->id = $usersModel->id;
        $_identity->setState('id', $usersModel->id);
        $_identity->setState('email', $usersModel->email);
        $_identity->setState('first_name', $usersModel->first_name);
        $_identity->setState('last_name', $usersModel->last_name);
        Yii::app()->user->login($_identity, 0);
        if($url_b){
            $this->redirect($url_b);
        }else{
            $this->redirect(Yii::app()->user->returnUrl);
        }
    }

    public function actionCancellation_policies(){
        $this->render('cancellation');
    }

    public function actionPrivacy_policies(){
        $this->pageTitle = Yii::t('app', 'Chính sách riêng tư');
        $this->render('privacy');
    }

    public function actionAbout(){
        $this->pageTitle = Yii::t('app', 'Giới thiệu shareroom');
        $this->render('about');
    }

    public function actionPolicy(){
        $this->pageTitle = Yii::t('app', 'Điều khoản & Điều kiện');
        $this->render('policy');
    }
}