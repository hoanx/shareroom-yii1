<?php

/**
 * This is the model class for table "tb_admin".
 *
 * The followings are the available columns in table 'tb_admin':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $created
 * @property string $updated
 * @property integer $del_flg
 */
class Admin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_admin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('email, username','unique'),
            array('email', 'email'),
			array('del_flg', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>50),
			array('password, email', 'length', 'max'=>255),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, email, created, updated, del_flg', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'username' => Yii::t('app', 'Tài khoản'),
			'password' => Yii::t('app', 'Mật khẩu'),
			'email' => Yii::t('app', 'Email'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('del_flg',Constant::DEL_FALSE);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Admin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave() {
        $this->password = self::encrypt($this->password);
        return parent::beforeSave();
    }

    /**
     * @param string $string
     * @return string md5
     */
    public static function encrypt($string="")
    {
        return md5($string);
    }
}