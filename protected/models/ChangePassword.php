<?php
/**
 * Class ChangePassword
 */
class ChangePassword extends CFormModel
{
    public $password; // password of user

	public $current_pass;
	public $new_pass;
	public $re_new_pass;
    public $sent_password;

	public function rules()
	{
		return array(
			array('current_pass, new_pass, re_new_pass', 'required'),
            array('new_pass, re_new_pass', 'length', 'min'=>8),
            array('re_new_pass', 'compare', 'compareAttribute'=>'new_pass'),
            array('current_pass','valid_password'),

		);
	}

    public function valid_password($attribute, $params){
        if($this->password!=Constant::DEFAULT_PASSWORD){
            if(Users::encrypt($this->$attribute) != $this->password){
                $this->addError($attribute, Yii::t('admin', 'Mật khẩu hiện tại không đúng!'));
            }
        }
    }

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'current_pass'=>Yii::t('admin', 'Mật khẩu hiện tại'),
			'new_pass'=>Yii::t('admin', 'Mật khẩu mới'),
			're_new_pass'=>Yii::t('admin', 'Nhập lại mật khẩu'),
			'sent_password'=>Yii::t('admin', 'Đồng ý gửi mật khẩu mới vào mail'),
		);
	}


}
