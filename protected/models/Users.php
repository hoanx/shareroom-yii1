<?php

/**
 * This is the model class for table "tb_user".
 *
 * The followings are the available columns in table 'tb_user':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $birthday
 * @property integer $gender
 * @property string $phone_number
 * @property string $description
 * @property string $address
 * @property string $profile_picture
 * @property string $google_id
 * @property string $facebook_id
 * @property string $created
 * @property string $updated
 * @property integer $del_flg
 */
class Users extends CActiveRecord
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    public $re_password;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password, email, first_name, last_name', 'required'),
			array('re_password', 'required', 'on'=>'register'),
            array('password', 'length', 'min'=>8),
            array('re_password', 'compare', 'compareAttribute'=>'password', 'on'=>'register'),
            array('email','email'),
            array('email','unique'),
			array('gender, del_flg', 'numerical', 'integerOnly'=>true),
			array('password, email, first_name, last_name, phone_number, address, google_id, facebook_id', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, birthday, password, email, first_name, last_name, gender, phone_number, description, address, profile_picture, google_id, facebook_id, created, updated, del_flg', 'safe'),
			array('id, birthday, password, email, first_name, last_name, gender, phone_number, description, address, profile_picture, google_id, facebook_id, created, updated, del_flg', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'username' => Yii::t('app', 'Tài khoản'),
			'password' => Yii::t('app', 'Mật khẩu'),
			're_password' => Yii::t('app', 'Nhập lại mật khẩu'),
			'email' => Yii::t('app', 'Email'),
			'first_name' => Yii::t('app', 'Tên'),
			'last_name' => Yii::t('app', 'Họ'),
			'gender' => Yii::t('app', 'Giới tính'),
			'birthday' => Yii::t('app', 'Ngày sinh'),
			'phone_number' => Yii::t('app', 'Số điện thoại'),
			'description' => Yii::t('app', 'Mô tả về bạn'),
			'address' => Yii::t('app', 'Địa chỉ'),
			'google_id' => Yii::t('app', 'google_id'),
			'facebook_id' => Yii::t('app', 'facebook_id'),
			'created' => Yii::t('app', 'Created'),
			'updated' => Yii::t('app', 'Updated'),
			'del_flg' => Yii::t('app', 'Del Flg'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('google_id',$this->google_id,true);
		$criteria->compare('facebook_id',$this->facebook_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('del_flg',$this->del_flg);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave() {
        if(empty($this->birthday)) $this->birthday = null;
        if($this->getScenario()=='register'){
            if($this->password!=Constant::DEFAULT_PASSWORD){
                // encrypt password
                $this->password = self::encrypt($this->password);
            }
        }

        $now = new CDbExpression('NOW()');
        if ($this->isNewRecord){
            $this->created = $now;
        }
        $this->updated = $now;
        return parent::beforeSave();
    }

    /**
     * @param null $id id gender
     * @return array array gender or name gender by id
     */
    public static function gender($id = null) {
        $result = array(
            0 => Yii::t('app','--Chọn giới tính--'),
            self::GENDER_MALE => Yii::t('app','Nam'),
            self::GENDER_FEMALE => Yii::t('app','Nữ'),
        );
        return !empty($result[$id]) ? $result[$id] : $result;
    }

    /**
     * Returns User model by its email
     *
     * @param string $email
     * @access public
     * @return User
     */
    public static function findByEmail($email)
    {
        return self::model()->findByAttributes(array('email' => $email, 'del_flg'=>0));
    }

    /**
     * return encrypt password user
     *
     * @param string $string
     * @return string
     */
    public static function encrypt($string="")
    {
        return md5($string);
    }
}
