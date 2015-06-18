<?php

/**
 * This is the model class for table "tb_room_images".
 *
 * The followings are the available columns in table 'tb_room_images':
 * @property integer $id
 * @property integer $room_address_id
 * @property string $image_name
 * @property string $created
 * @property string $updated
 */
class RoomImages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_room_images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('room_address_id, image_name', 'required'),
			array('room_address_id', 'numerical', 'integerOnly'=>true),
			array('image_name', 'length', 'max'=>255),
			array('created, updated, del_flg', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, room_address_id, image_name, created, updated', 'safe', 'on'=>'search'),
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
			'room_address_id' => 'Room Address',
			'image_name' => 'Image Name',
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
		$criteria->compare('image_name',$this->image_name,true);
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
	 * @return RoomImages the static model class
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

    public static function getImageByRoomaddress($room_address_id = null){
        if(is_null($room_address_id)) return false;

        $imageModel = RoomImages::model()->findByAttributes(array(
            'room_address_id' => $room_address_id,
            'del_flg' => 0
        ));

        if($imageModel && $imageModel->image_name){
            $pathFileImage =  Yii::app()->basePath . '/..' . Constant::PATH_UPLOAD_PICTURE . $imageModel->image_name;
            if(file_exists($pathFileImage)){
                return Yii::app()->baseUrl . Constant::PATH_UPLOAD_PICTURE . $imageModel->image_name;
            }
        }
        return Yii::app()->baseUrl . Constant::PATH_UPLOAD_PICTURE . 'no-image.jpg';
    }
}
