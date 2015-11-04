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
 * @property integer $status_flg
 * @property string $created
 * @property string $updated
 * @property integer $del_flg
 */
class RoomAddress extends CActiveRecord
{
    public $distance;
    public $keyword;
    public $email;
    public $first_name;
    public $last_name;
    public $price;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
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
			array('user_id, address_detail, address, district, city, lat, long, name, description, accommodates,
			    bedrooms, beds, room_size, room_type', 'required'),
			array('user_id, accommodates, bedrooms, beds, room_size, del_flg', 'numerical', 'integerOnly'=>true),
			array('lat, long', 'numerical'),
			array('address_detail, address, district, city, name', 'length', 'max'=>255),
			array('description', 'length', 'min'=>Constant::MIN_LEN_ROOM_DESCRIPTION),
			array('description, created, updated, room_type, amenities, status_flg, distance', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, address_detail, address, district, city, lat, long, name, description, room_type,
			    accommodates, bedrooms, beds, room_size, amenities, created, updated, del_flg, status_flg, keyword, 
		        email, first_name, last_name, price', 'safe', 'on'=>'search'),

            array('status_flg', 'validateEnable', 'on'=>'enable_status'),
		);
	}

    /**
     * required on enable status
     *
     * @param $attribute_name
     * @param $params
     * @return bool
     */
    public function validateEnable($attribute_name, $params)
    {
        $checkErr = false;
        if ($this->$attribute_name) {
            $countImg = RoomImages::model()->count("room_address_id = :room_address_id AND del_flg = :del_flg",
                array(
                    "room_address_id" => $this->id,
                    ':del_flg' => Constant::DEL_FALSE
                ));

            if($countImg < Constant::MIN_IMAGE_ROOM){
                $checkErr = true;
                $this->addError($attribute_name,
                    Yii::t('app', 'Bạn cần phải tải lên ít nhất {so_anh} ảnh để kích hoạt danh sách của mình.',
                        array('{so_anh}'=>Constant::MIN_IMAGE_ROOM)));
            }

            if(strlen($this->name) < Constant::MIN_LEN_ROOM_NAME){
                $checkErr = true;
                $this->addError('name',
                    Yii::t('app', 'Tiêu đề danh sách của bạn nên chứa ít nhất {len_room_name} ký tự.',
                        array('{len_room_name}'=>Constant::MIN_LEN_ROOM_NAME)));
            }

            if(strlen($this->description) < Constant::MIN_LEN_ROOM_DESCRIPTION){
                $checkErr = true;
                $this->addError('description',
                    Yii::t('app', 'Mô tả danh sách của bạn nên chứa ít nhất {len_room_description} ký tự.',
                        array('{len_room_description}'=>Constant::MIN_LEN_ROOM_DESCRIPTION)));
            }

            if($checkErr){
                return false;
            }
        }
        return true;
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'Users' => array(self::BELONGS_TO, 'Users', 'user_id'),
            'RoomPrice' => array(self::HAS_ONE, 'RoomPrice', 'room_address_id'),
	        'RoomImages' => array(self::HAS_MANY, 'RoomImages', 'room_address_id', 'condition'=> "RoomImages.del_flg = 0"),

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
			'accommodates' => Yii::t('app', 'Số khách tối đa'),
			'bedrooms' => Yii::t('app', 'Phòng ngủ'),
			'beds' => Yii::t('app', 'Giường'),
			'room_size' => Yii::t('app', 'Diện tích'),
			'amenities' => Yii::t('app', 'Tiện nghi'),
			'status_flg' => Yii::t('app', 'Trạng thái'),
			'created' => 'Created',
			'updated' => 'Updated',
			'del_flg' => 'Del Flg',
	        'price' => 'Giá'
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
		
		$criteria->with = array('Users', 'RoomPrice');
		
        if (!isset($this->keyword)) {
            $criteria->compare('t.id',$this->id);
            $criteria->compare('t.user_id',$this->user_id);
            $criteria->compare('t.address_detail',$this->address_detail,true);
            $criteria->compare('t.address',$this->address,true);
            $criteria->compare('t.district',$this->district,true);
            $criteria->compare('t.city',$this->city,true);
            $criteria->compare('t.lat',$this->lat);
            $criteria->compare('t.long',$this->long);
            $criteria->compare('t.name',$this->name,true);
            $criteria->compare('t.description',$this->description,true);
            $criteria->compare('t.room_type',$this->room_type,true);
            $criteria->compare('t.accommodates',$this->accommodates);
            $criteria->compare('t.bedrooms',$this->bedrooms);
            $criteria->compare('t.beds',$this->beds);
            $criteria->compare('t.room_size',$this->room_size);
            $criteria->compare('t.status_flg',$this->status_flg);
            $criteria->compare('t.amenities',$this->amenities,true);
            $criteria->compare('Users.email',$this->email,true);
            $criteria->compare('Users.first_name',$this->first_name,true);
            $criteria->compare('Users.last_name',$this->last_name,true);
            $criteria->compare('RoomPrice.price',$this->price,true);
        }else{
            $criteria->compare('t.id',$this->keyword, true, 'OR');
            $criteria->compare('t.address_detail',$this->keyword,true, 'OR');
            $criteria->compare('t.address',$this->keyword,true, 'OR');
            $criteria->compare('t.district',$this->keyword,true, 'OR');
            $criteria->compare('t.city',$this->keyword,true, 'OR');
            $criteria->compare('t.name',$this->keyword,true, 'OR');
            $criteria->compare('t.description',$this->keyword,true, 'OR');
            $criteria->compare('Users.email',$this->keyword,true, 'OR');
            $criteria->compare('Users.first_name',$this->keyword,true, 'OR');
            $criteria->compare('Users.last_name',$this->keyword,true);
        }
        
        $criteria->compare('t.del_flg',Constant::DEL_FALSE);

        $sort = new CSort;
        $sort->attributes = array(
            '*',
            'email' => array(
                'asc' => 'Users.email ASC',
                'desc' => 'Users.email DESC',
            ),
            'first_name' => array(
                'asc' => 'Users.first_name ASC',
                'desc' => 'Users.first_name DESC',
            ),
            'last_name' => array(
                'asc' => 'Users.last_name ASC',
                'desc' => 'Users.last_name DESC',
            ),
            'price' => array(
                'asc' => 'RoomPrice.price ASC',
                'desc' => 'RoomPrice.price DESC',
            )
        );
        $sort->defaultOrder = 't.id desc';
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => Constant::PAGE_SIZE
            ),
            'sort' => $sort,
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RoomAddress the static model class
	 */
	public static function model($className = __CLASS__)
	{
	    return parent::model($className);
	}
	
    public function beforeSave() {
        $now = new CDbExpression('NOW()');
        
        if(is_array($this->amenities)) {
            $this->amenities = serialize($this->amenities);
        }
        
        if ($this->isNewRecord){
            $this->created = $now;
        }
        $this->updated = $now;
        return parent::beforeSave();
    }

    /**
     * Get list room by user id
     *
     * @param null $user_id
     * @return bool|static[]
     */
    public static function getRoomByUserId($user_id = null){
        if(is_null($user_id)) return false;

        $criteria = new CDbCriteria();
        $criteria->with = array('RoomPrice', 'Users');
        $criteria->compare('t.del_flg', Constant::DEL_FALSE);
        $criteria->compare('Users.id', $user_id);

        return self::model()->findAll($criteria);
    }

    public static function getRoomType($room_type = null, $title = false) {
        $room_type = unserialize($room_type);
        
        if(is_array($room_type)) {
            if($title) {
                foreach($room_type as $v) {
                    $result[] = Constant::getRoomType($v);
                }
                
                return $result;
            } else {
                return $room_type;                
            }
        }
        
        return array();
    }
    
    public static function iconRoomType($room_type) {
        switch ($room_type) {
            case Constant::ROOM_TYPE_ENTIRE_HOME:
                echo '<i class="fa fa-building"></i><br>' . Yii::t('app', 'Cả căn hộ');
                break;
            case Constant::ROOM_TYPE_PRIVATE_ROOM:
                echo '<i class="fa fa-home"></i><br>' . Yii::t('app', 'Phòng riêng');
                break;
            case Constant::ROOM_TYPE_SHARE_ROOM:
                echo '<i class="fa fa-share-alt"></i><br>' . Yii::t('app', 'Phòng chia sẻ');
                break;
            default:
                echo '';
                break;
        }
    }
    
    public static function checkSort($data = null) {
        if(isset($_GET['sort']) && $_GET['sort'] == $data) echo 'active';
        
    }
    
    public static function checkRoomtype($data = null, $checkbox = false) {
        if(isset($_GET['room_type']) && strpos($_GET['room_type'], $data) !== false) {
            echo ($checkbox) ?  'checked' : 'active'; 
        }
    }
    
    public static function getRooms($data) {
        $earthRadius = '3963.0';
        $latitude = $data['lat'];
        $longitude = $data['long'];
    
        $criteria = new CDbCriteria();
        $criteria->with = 'RoomPrice';
    
        $criteria->condition = 't.del_flg = :del_flg AND t.status_flg = 1';

        if(isset($latitude) && $latitude) {
            $maxLat = $latitude + 0.4;
            $minLat = $latitude - 0.4;
            $criteria->condition .= ' AND t.lat < ' . $maxLat;
            $criteria->condition .= ' AND t.lat > ' . $minLat;
        }
        
        if(isset($longitude) && $longitude) {
            $maxLong = $longitude + 0.4;
            $minLong = $longitude - 0.4;
            $criteria->condition .= ' AND t.long < ' . $maxLong;
            $criteria->condition .= ' AND t.long > ' . $minLong;
        }
        
        if(isset($data['bedrooms']) && $data['bedrooms']) {
            $criteria->condition .= ' AND t.bedrooms = ' . $data['bedrooms'];
        }
    
        if(isset($data['beds']) && $data['beds']) {
            $criteria->condition .= ' AND t.beds = ' . $data['beds'];
        }
    
        if(isset($data['accommodates']) && $data['accommodates']) {
            $criteria->condition .= ' AND t.accommodates >= ' . $data['accommodates'];
        }
    
        if(isset($data['price']) && $data['price']) {
            $prices = explode(",", $data['price']);
            $criteria->condition .= ' AND RoomPrice.price >= ' . $prices[0] . ' AND RoomPrice.price <= ' . $prices[1];
        }
    
        if(isset($data['room_type']) && $data['room_type']) {
            $types = explode(",", $data['room_type']);
            $query_parts = array();
            foreach($types as $type) {
                $query_parts[] = "'%". addslashes($type) ."%'";
            }
    
            if(!empty($query_parts)) {
                $string = implode(' OR t.room_type LIKE ', $query_parts);
                $criteria->condition .= ' AND (t.room_type LIKE ' . $string . ') ';
            }
        }
    
        if(isset($data['amenities']) && $data['amenities']) {
            $amenities = explode(",", $data['amenities']);
            $query_parts = array();
            foreach($amenities as $amenitie) {
                $query_parts[] = "'%". addslashes($amenitie) ."%'";
            }
    
            if(!empty($query_parts)) {
                $string = implode(' AND t.amenities LIKE ', $query_parts);
                $criteria->condition .= ' AND (t.amenities LIKE ' . $string  . ') ';
            }
        }
    
    
        $criteria->params = array(
            ':del_flg' => Constant::DEL_FALSE,
        );
    
        if(isset($data['sort'])) {
            if($data['sort'] == 'price_desc') {
                $criteria->order = 'RoomPrice.price DESC';
            } else {
                $criteria->order = 'RoomPrice.price ASC';
            }
        } 
    
//         $count = RoomAddress::model()->count($criteria);
        
//         $criteria->limit = Constant::PAGE_ROOM;
        
//         if(isset($data['page']) && $data['page']) {
//            $criteria->offset = $data['page'];
//         }
        
        $model = RoomAddress::model()->findAll($criteria);
        
        if(isset($data['startdate']) && $data['startdate'] && isset($data['enddate']) && $data['enddate']) {
            foreach($model as $k => $room) {
                $criteria = new CDbCriteria();
                $criteria->condition = 't.date > :start_date AND t.date < :end_date AND t.room_address_id = :room_address_id';
                $criteria->params = array(
                    ':start_date' => date("Y-m-d", strtotime($data['startdate'])),
                    ':end_date' => date("Y-m-d", strtotime($data['enddate'])),
                    ':room_address_id' => $room->id,
                );
                
                $roomset = RoomSet::model()->findAll($criteria);
                
                if($roomset) {
                    unset($model[$k]);
                }
            }
        }
        
        return $model;
    }
    
    public static function listAmenities() {
        $amenities = Constant::getAmenities();
        $amenities = array_flip($amenities);
        $amenities = array_fill_keys($amenities, 0);
        return $amenities;
    }

    /**
     * Get owner info by room
     *
     * @param $room_address_id
     * @return array|bool|mixed|null
     */
    public static function getOwnerRoom($room_address_id){
        $criteria = new CDbCriteria();
        $criteria->compare('del_flg', Constant::DEL_FALSE);
        $roomAddressModel = self::model()->findByPk($room_address_id);
        if($roomAddressModel){
            return $roomAddressModel->Users;
        }

        return false;
    }

    public static function getListStatus($type=null){
        $base = array(
            self::STATUS_DISABLE => Yii::t('app', 'Ẩn'),
            self::STATUS_ENABLE => Yii::t('app', 'Hiện'),
        );

        return !empty($base[$type]) ? $base[$type] : $base;
    }
}
