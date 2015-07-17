<?php

/**
 * This is the model class for table "tb_users_bank".
 *
 * The followings are the available columns in table 'tb_users_bank':
 * @property integer $id
 * @property integer $user_id
 * @property string $bank_number
 * @property string $bank_name
 * @property string $bank_branch
 * @property string $bank_holder_name
 * @property string $created
 * @property string $updated
 * @property integer $del_flg
 */
class UsersBank extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_users_bank';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, bank_number, bank_name, bank_branch, bank_holder_name', 'required'),
			array('user_id, del_flg', 'numerical', 'integerOnly'=>true),
			array('bank_number, bank_name, bank_branch, bank_holder_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, bank_number, bank_name, bank_branch, bank_holder_name, created, updated, del_flg', 'safe', 'on'=>'search'),
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
			'user_id' => Yii::t('app', 'Tài khoản'),
			'bank_number' => Yii::t('app', 'Số tài khoản'),
			'bank_name' => Yii::t('app', 'Tên ngân hàng'),
			'bank_branch' => Yii::t('app', 'Tên chi nhánh'),
			'bank_holder_name' => Yii::t('app', 'Tên chủ tài khoản'),
			'created' => Yii::t('app', 'Ngày tạo'),
			'updated' => Yii::t('app', 'Ngày sửa')
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('bank_number',$this->bank_number,true);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('bank_branch',$this->bank_branch,true);
		$criteria->compare('bank_holder_name',$this->bank_holder_name,true);
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
	 * @return UsersBank the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave() {
        $now = new CDbExpression('NOW()');

        if ($this->isNewRecord){
            $this->created = $now;
        }
        $this->updated = $now;
        return parent::beforeSave();
    }
}
