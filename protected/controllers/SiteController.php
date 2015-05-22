<?php

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphUser;

class SiteController extends Controller
{
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
        if(in_array($action->id, $arrAction) && Yii::app()->user->isGuest){

            $this->_initFacebookSDK();
//            $this->_initGPlusSDK();
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
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionSignIn()
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
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('signin',array('model'=>$model));
	}


    /**
     * Displays the sign up page
     */
    public function actionSignUp()
    {
        $this->pageTitle = Yii::t('app', 'Đăng ký');

        $usersModel = new Users('register');
        if(isset($_POST['Users']))
        {
            $usersModel->attributes=$_POST['Users'];
            $password = $usersModel->password;
            if($usersModel->save()){
                $this->_login($usersModel, $password);
            }
        }elseif(!is_null($this->userInfoFacebook)){
            $email = $this->userInfoFacebook['email'];
            $user_exists = Users::findByEmail($email);
            if($user_exists){
                $this->_login($usersModel, Constant::DEFAULT_PASSWORD);
            }else{
                $userFacebookModel = new Users();
                $userFacebookModel->attributes=$this->userInfoFacebook;
                $userFacebookModel->save(false);
                $this->_login($usersModel, $userFacebookModel->password);
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

    protected function _initFacebookSDK(){
        $app_id = Yii::app()->facebook->appId;
        $app_secret = Yii::app()->facebook->secret;
        FacebookSession::setDefaultApplication($app_id, $app_secret);
        $refirect_url = Yii::app()->createAbsoluteUrl('site/signup');
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
            $requestProfile = ( new FacebookRequest( $session, 'GET', '/me' ) )->execute();
            $userProfile = $requestProfile->getGraphObject(GraphUser::className())->asArray();

            // Get User’s Profile Picture
            $requestPicture = ( new FacebookRequest( $session, 'GET', '/me/picture?type=large&redirect=false' ) )->execute();
            $userPicture = $requestPicture->getGraphObject(GraphUser::className())->asArray();

            $gender = 0;
            if($userProfile['gender']=='male') $gender = Users::GENDER_MALE;
            if($userProfile['gender']=='female') $gender = Users::GENDER_FEMALE;

            $this->userInfoFacebook = array(
                'facebook_id' => $userProfile['id'],
                'email' => $userProfile['email'],
                'birthday' => $userProfile['birthday'] ? date('Y-m-d', strtotime($userProfile['birthday'])) : null,
                'first_name' => $userProfile['first_name'],
                'last_name' => $userProfile['last_name'],
                'profile_picture' => $userPicture['url'],
                'gender' => $gender,
                'password' => Constant::DEFAULT_PASSWORD,
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
        $scope = 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.login';
        $client->addScope($scope);

        $this->loginGplusUrl = $client->createAuthUrl();
//        $oauth2 = new Google_Service_OAuth2($client);
//        $userInfo = $oauth2->userInfo;



    }

    /**
     * Set login after signup
     *
     * @param object $usersModel
     * @param string $password
     */
    protected function _login($usersModel, $password){
        //Set login
        $_identity = new UserIdentity($usersModel->email, $password);
        $_identity->id = $usersModel->id;
        $_identity->setState('id', $usersModel->id);
        $_identity->setState('email', $usersModel->email);
        $_identity->setState('first_name', $usersModel->first_name);
        $_identity->setState('last_name', $usersModel->last_name);
        Yii::app()->user->login($_identity, 0);
        $this->redirect(Yii::app()->user->returnUrl);
    }
}