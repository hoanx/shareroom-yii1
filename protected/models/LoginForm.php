<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
    public $email;
    public $password;
    public $rememberMe;

    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that email and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // email and password are required
            array('email, password', 'required'),
            array('email', 'email'),
            array('password', 'length', 'min' => 8),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'rememberMe' => Yii::t('app', 'Nhớ tôi'),
            'email' => Yii::t('app', 'Tài khoản'),
            'password' => Yii::t('app', 'Mật khẩu'),
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params)
    {
        if (!$this->hasErrors()) {

            $this->_identity = new UserIdentity($this->email, $this->password);
            if (!$this->_identity->authenticate()){
                if ($this->_identity->errorCode == UserIdentity::ERROR_USERNAME_INVALID) {
                    $this->addError('email', Yii::t('app', 'Địa chỉ Email không đúng. Vui lòng thử lại.'));
                } elseif ($this->_identity->errorCode == UserIdentity::ERROR_PASSWORD_INVALID) {
                    $this->addError('password', Yii::t('app', 'Mật khẩu không đúng. Vui lòng thử lại.'));
                } elseif ($this->_identity->errorCode == UserIdentity::ERROR_EMAIL_FACEBOOK) {
                    $this->addError('email', Yii::t('app', 'Bạn đã đăng ký bằng facebook. Vui lòng đăng nhập bằng facebook.'));
                } elseif ($this->_identity->errorCode == UserIdentity::ERROR_EMAIL_GOOGLE_PLUS) {
                    $this->addError('email', Yii::t('app', 'Bạn đã đăng ký bằng google plus. Vui lòng đăng nhập bằng google plus.'));
                }
            }
        }
    }

    /**
     * Logs in the user using the given email and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->email, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else
            return false;
    }
}
