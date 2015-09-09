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
    public $keyword;
    public $sent_pass_to_email = 1;
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
            array('email, username','required'),
            array('password', 'required', 'on'=>'register'),
            array('email', 'email'),
			array('del_flg, sent_pass_to_email', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>50),
			array('password, email', 'length', 'max'=>255),
			array('password', 'length', 'min'=>8),
			array('created, updated, keyword, sent_pass_to_email', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, email, created, updated, del_flg, keyword', 'safe', 'on'=>'search'),
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
            'keyword' => Yii::t('app', 'Từ khoá'),
            'sent_pass_to_email' => Yii::t('app', 'Gửi mật khẩu vào email'),
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
        $criteria->compare('del_flg',Constant::DEL_FALSE);

        if (!isset($this->keyword)) {
            $criteria->compare('t.id',$this->id);
            $criteria->compare('t.email',$this->email,true);
            $criteria->compare('t.username',$this->username,true);
        }else{
            $criteria->compare('t.id',$this->keyword, true);
            $criteria->compare('t.email',$this->keyword,true, 'OR');
            $criteria->compare('t.username',$this->keyword,true, 'OR');
        }

		return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => Constant::PAGE_SIZE
            ),
            'sort' => array(
                'defaultOrder' => 't.id asc',
            ),
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
        if($this->password){
            if($this->sent_pass_to_email){
                $subject = Yii::t('app', 'Mật khẩu mới');
                $content = Yii::app()->controller->renderPartial('//template/password_for_manager', array('model' => $this), true, true);
                Common::sendMail($this->email, $subject, $content);

            }
            $this->password = self::encrypt($this->password);
        }

        $now = new CDbExpression('NOW()');
        if ($this->isNewRecord){
            $this->created = $now;
        }
        $this->updated = $now;
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
