<?php

class AdminLogin extends CFormModel {
    public $username;
    public $password;
    public $error;
    private $_identity;
    
    public function rules() {
        return array(
            array('username, password','required'),
            array('password','authenticate') 
        );
    }
    
    public function attributeLabels() {
        return array(
        	'username' => Yii::t('admin', 'Admin ID'),
        	'password' => Yii::t('admin', 'Password')
        );
    }
    
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {
            $this->_identity = new AdminIdentity($this->username, $this->password);
            if (!$this->_identity->authenticate()) $this->addError('error', Yii::t('admin', 'Incorrect username or password.'));
        }
    }
    
    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new AdminIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        
        if ($this->_identity->errorCode === AdminIdentity::ERROR_NONE) {
            Yii::app()->getModule('admin')->user->login($this->_identity);
            return true;
        } else return false;
    }
}
