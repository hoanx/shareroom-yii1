<?php

/**
 * This is the model class for table "tb_booking_history".
 *
 * The followings are the available columns in table 'tb_booking_history':
 * @property integer $id
 * @property integer $booking_id
 * @property string $room_name
 * @property string $room_address_detail
 * @property string $room_address
 * @property string $room_district
 * @property string $room_city
 * @property double $room_lat
 * @property double $room_long
 * @property string $created
 * @property string $updated
 * @property integer $del_flg
 */
class BookingHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_booking_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('booking_id, room_name, room_address_detail, room_address, room_district, room_city, room_lat, room_long', 'required'),
			array('booking_id, del_flg', 'numerical', 'integerOnly'=>true),
			array('room_lat, room_long', 'numerical'),
			array('room_name, room_address_detail, room_address, room_district, room_city', 'length', 'max'=>255),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, booking_id, room_name, room_address_detail, room_address, room_district, room_city, room_lat, room_long, created, updated, del_flg', 'safe', 'on'=>'search'),
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
			'room_name' => 'Room Name',
			'room_address_detail' => 'Room Address Detail',
			'room_address' => 'Room Address',
			'room_district' => 'Room District',
			'room_city' => 'Room City',
			'room_lat' => 'Room Lat',
			'room_long' => 'Room Long',
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
		$criteria->compare('room_name',$this->room_name,true);
		$criteria->compare('room_address_detail',$this->room_address_detail,true);
		$criteria->compare('room_address',$this->room_address,true);
		$criteria->compare('room_district',$this->room_district,true);
		$criteria->compare('room_city',$this->room_city,true);
		$criteria->compare('room_lat',$this->room_lat);
		$criteria->compare('room_long',$this->room_long);
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
	 * @return TbBookingHistory the static model class
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
