<?php

/**
 * This is the model class for table "tb_booking_payment".
 *
 * The followings are the available columns in table 'tb_booking_payment':
 * @property integer $id
 * @property integer $booking_id
 * @property string $bank_number
 * @property string $bank_name
 * @property string $bank_branch
 * @property string $bank_holder_name
 * @property string $card_number
 * @property string $card_code
 * @property string $card_expire
 * @property string $created
 * @property string $updated
 * @property integer $del_flg
 */
class BookingPayment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_booking_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('booking_id', 'required'),
			array('booking_id, del_flg', 'numerical', 'integerOnly'=>true),
			array('bank_number, bank_name, bank_branch, bank_holder_name, card_number, card_code, card_expire', 'length', 'max'=>255),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, booking_id, bank_number, bank_name, bank_branch, bank_holder_name, card_number, card_code, card_expire, created, updated, del_flg', 'safe', 'on'=>'search'),
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
            'Booking' => array(self::BELONGS_TO, 'Booking', 'booking_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'booking_id' => 'Booking',
			'bank_number' => Yii::t('app', 'Số tài khoản'),
			'bank_name' => Yii::t('app', 'Tên ngân hàng'),
			'bank_branch' => Yii::t('app', 'Tên chi nhánh'),
			'bank_holder_name' => Yii::t('app', 'Tên chủ thẻ'),
			'card_number' => Yii::t('app', 'Số tài khoản'),
			'card_code' => Yii::t('app', 'Code'),
			'card_expire' => Yii::t('app', 'Ngày hết hạn'),
			'created' => 'Created',
			'updated' => 'Updated',
			'del_flg' => 'Del Flg',
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
		$criteria->compare('booking_id',$this->booking_id);
		$criteria->compare('bank_number',$this->bank_number,true);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('bank_branch',$this->bank_branch,true);
		$criteria->compare('bank_holder_name',$this->bank_holder_name,true);
		$criteria->compare('card_number',$this->card_number,true);
		$criteria->compare('card_code',$this->card_code,true);
		$criteria->compare('card_expire',$this->card_expire,true);
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
	 * @return BookingPayment the static model class
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
