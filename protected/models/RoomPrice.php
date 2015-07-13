<?php

/**
 * This is the model class for table "tb_room_price".
 *
 * The followings are the available columns in table 'tb_room_price':
 * @property integer $id
 * @property integer $room_address_id
 * @property double $price
 * @property double $weekly
 * @property double $monthly
 * @property double $additional_guests // Phi khi them 1 khach
 * @property double $guest_per_night // Phi khi them 1 khach
 * @property double $cleaning_fees
 * @property integer $cleaning_fees_day // Tinh phi ve sinh theo ngay dem hoac 1 lan o
 * @property integer $cancellation // Chinh sach huy bo
 * @property string $house_rules // Quy dinh cua nha tro
 * @property integer $min_nights
 * @property integer $max_nights
 * @property string $check_in
 * @property string $check_out
 * @property string $created
 * @property string $updated
 */
class RoomPrice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_room_price';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('room_address_id, price, check_in, check_out', 'required'),
			array('room_address_id, min_nights, max_nights, cancellation, guest_per_night, cleaning_fees_day', 'numerical', 'integerOnly'=>true),
			array('price, weekly, monthly, additional_guests, cleaning_fees', 'numerical'),
			array('price, weekly, monthly, additional_guests, cleaning_fees, min_nights, cleaning_fees_day
			    max_nights, cancellation, house_rules, created, updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, room_address_id, price, weekly, monthly, additional_guests, cleaning_fees, min_nights, max_nights,
			check_in, check_out, created, updated, cleaning_fees_day, guest_per_night', 'safe', 'on'=>'search'),
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
            'RoomAddress' => array(self::BELONGS_TO, 'RoomAddress', 'room_address_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'room_address_id' => 'Room Address',
			'price' => Yii::t('app', 'Theo đêm'),
			'weekly' => Yii::t('app', 'Theo tuần'),
			'monthly' => Yii::t('app', 'Theo tháng'),
			'additional_guests' => Yii::t('app', 'Phí cho mỗi khách thêm'),
			'guest_per_night' => Yii::t('app', 'Phí cho mỗi khách thêm theo đêm theo số khách'),
			'cleaning_fees' => Yii::t('app', 'Phí dọn dẹp'),
			'guest_per_night' => Yii::t('app', 'Phí dọn dẹp tính theo ngày'),
            'cancellation' => Yii::t('app', 'Chính sách huỷ bỏ'),
            'house_rules' => Yii::t('app', 'Quy định'),
			'min_nights' => Yii::t('app', 'Số đêm tối thiểu'),
			'max_nights' => Yii::t('app', 'Số đêm tối đa'),
			'check_in' => Yii::t('app', 'Thời gian nhận phòng sau'),
			'check_out' => Yii::t('app', 'Thời gian trả phòng trước'),
			'created' => 'Created',
			'updated' => 'Updated',
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
		$criteria->compare('room_address_id',$this->room_address_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('weekly',$this->weekly);
		$criteria->compare('monthly',$this->monthly);
		$criteria->compare('additional_guests',$this->additional_guests);
		$criteria->compare('cleaning_fees',$this->cleaning_fees);
		$criteria->compare('min_nights',$this->min_nights);
		$criteria->compare('max_nights',$this->max_nights);
		$criteria->compare('cancellation',$this->cancellation);
		$criteria->compare('house_rules',$this->house_rules, true);
		$criteria->compare('check_in',$this->check_in,true);
		$criteria->compare('check_out',$this->check_out,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RoomPrice the static model class
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
