<?php
class AdminIdentity extends CUserIdentity {
    public $id;
    public function authenticate() {

        $adminObj = Admin::model()->findByAttributes(array('username'=>$this->username, 'del_flg'=>0));
        if($adminObj===null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if(Admin::encrypt($this->password)!==$adminObj->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->id=$adminObj->id;
            $this->setState('id', $adminObj->id);
            $this->setState('name', $adminObj->username);

            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId()
    {
        return $this->id;
    }
}