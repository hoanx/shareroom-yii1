<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_EMAIL_FACEBOOK=3;
    const ERROR_EMAIL_GOOGLE_PLUS=4;
    public $id;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $userModel = Users::model()->findByAttributes(array('email' => $this->username, 'del_flg' => 0));
        if ($userModel === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if (Users::encrypt($this->password) !== $userModel->password){
            if($userModel->facebook_id){
                $this->errorCode = self::ERROR_EMAIL_FACEBOOK;
            }elseif($userModel->google_id){
                $this->errorCode = self::ERROR_EMAIL_GOOGLE_PLUS;
            }else{
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            }
        }
        else {
            $this->id = $userModel->id;
            $this->setState('id', $userModel->id);
            $this->setState('email', $userModel->email);
            $this->setState('first_name', $userModel->first_name);
            $this->setState('last_name', $userModel->last_name);

            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;

    }

    public function getId()
    {
        return $this->id;
    }
}