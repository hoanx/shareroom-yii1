<?php

/**
 * This is the model class for table "tb_room_set".
 *
 * The followings are the available columns in table 'tb_room_set':
 * @property integer $id
 * @property string $date
 */
class RoomSet extends CActiveRecord
{
    public $start_date;
    public $end_date;
    public $status;
    
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 2;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_room_set';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, room_address_id', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
	        array('start_date, end_date, status', 'safe'),
			array('id, date', 'safe', 'on'=>'search'),
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
			'date' => 'Date',
	        'start_date' => Yii::t('app', 'Từ ngày'),
	        'end_date' => Yii::t('app', 'Đến ngày'),
	        'status' => Yii::t('app', 'Tính sẵn sàng'),
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('room_address_id',$this->room_address_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RoomSet the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function statusFlag($status = null) {
	    $base = array(
            '' => Yii::t('app', ''),
            self::STATUS_ENABLE => Yii::t('app', 'Còn trống'),
            self::STATUS_DISABLE => Yii::t('app', 'Hết phòng')
	    );
	    return !empty($base[$status]) ? $base[$status] : $base;
	}

    public static function getDateBookingByRoomAddress($room_address_id){
        $listDate = array();
        $criteria = new CDbCriteria();
        $criteria->compare('room_address_id', $room_address_id);
        $model = self::model()->findAll($criteria);
        if($model){
            foreach($model as $data){
                $listDate[] = date('m/d/Y', strtotime($data->date));
            }
        }

        return $listDate;
    }
}
