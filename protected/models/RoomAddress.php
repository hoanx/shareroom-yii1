<?php

/**
 * This is the model class for table "tb_room_address".
 *
 * The followings are the available columns in table 'tb_room_address':
 * @property integer $id
 * @property integer $user_id
 * @property string $address_detail
 * @property string $address
 * @property string $district
 * @property string $city
 * @property double $lat
 * @property double $long
 * @property string $name
 * @property string $description
 * @property string $room_type
 * @property integer $accommodates
 * @property integer $bedrooms
 * @property integer $beds
 * @property integer $room_size
 * @property string $amenities
 * @property string $created
 * @property string $updated
 * @property integer $del_flg
 */
class RoomAddress extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_room_address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, address_detail, address, district, city, lat, long, name, description, accommodates, bedrooms, beds, room_size', 'required'),
			array('user_id, accommodates, bedrooms, beds, room_size, del_flg', 'numerical', 'integerOnly'=>true),
			array('lat, long', 'numerical'),
			array('address_detail, address, district, city, name, description, room_type, amenities', 'length', 'max'=>255),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, address_detail, address, district, city, lat, long, name, description, room_type, accommodates, bedrooms, beds, room_size, amenities, created, updated, del_flg', 'safe', 'on'=>'search'),
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
			'user_id' => Yii::t('app', 'User'),
			'address_detail' => Yii::t('app', 'Địa chỉ của bạn'),
			'address' => Yii::t('app', 'Địa chỉ'),
			'district' => Yii::t('app', 'Quận/ Huyện'),
			'city' => Yii::t('app', 'Tỉnh/ Thành phố'),
			'lat' => Yii::t('app', 'Lat'),
			'long' => Yii::t('app', 'Long'),
			'name' => Yii::t('app', 'Tên bài đăng'),
			'description' => Yii::t('app', 'Mô tả'),
			'room_type' => Yii::t('app', 'Loại phòng'),
			'accommodates' => Yii::t('app', 'Số khách'),
			'bedrooms' => Yii::t('app', 'Phòng ngủ'),
			'beds' => Yii::t('app', 'Giường'),
			'room_size' => Yii::t('app', 'Diện tích'),
			'amenities' => Yii::t('app', 'Tiện nghi'),
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('address_detail',$this->address_detail,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('district',$this->district,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('long',$this->long);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('room_type',$this->room_type,true);
		$criteria->compare('accommodates',$this->accommodates);
		$criteria->compare('bedrooms',$this->bedrooms);
		$criteria->compare('beds',$this->beds);
		$criteria->compare('room_size',$this->room_size);
		$criteria->compare('amenities',$this->amenities,true);
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
	 * @return RoomAddress the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


}
