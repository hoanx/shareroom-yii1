<?php

/**
 * This is the model class for table "tb_booking".
 *
 * The followings are the available columns in table 'tb_booking':
 * @property integer $id
 * @property integer $user_id
 * @property integer $room_address_id
 * @property string $check_in
 * @property string $time_check_in
 * @property string $check_out
 * @property string $time_check_out
 * @property integer $number_of_guests
 * @property double $room_price
 * @property double $cleaning_fees
 * @property double $additional_guests
 * @property double $price_additional_guests
 * @property string $coupon_code
 * @property double $discount
 * @property integer $total_amount
 * @property string $payment_method
 * @property integer $payment_status
 * @property integer $booking_status
 * @property string $invoice_date
 * @property string $refund_date
 * @property string $created
 * @property string $updated
 * @property integer $del_flg
 * @property integer $sent_to_adpia
 *
 * @todo: 2 trường $additional_guests và $price_additional_guests hiện tại chưa sử dụng vì ko chọn được nhiều hơn số khách tối đa
 */
class Booking extends CActiveRecord
{
    const PAYMENT_METHOD_BANK_TRANFER = 'banktranfer';
    const PAYMENT_METHOD_COMPANY = 'company';
    const PAYMENT_METHOD_SMARTLINK = 'smartlink';
    const STATUS_UNPAID = 1;
    const STATUS_PAID = 2;
    const STATUS_FAILS = 3;
    const STATUS_CANCEL = 4;
    const STATUS_PAID_USER = 5;
    const BOOKING_STATUS_PENDING = 1;
    const BOOKING_STATUS_UNACCEPT = 2;
    const BOOKING_STATUS_ACCEPT = 3;
    const BOOKING_STATUS_USER_CANCEL = 4;

    public $keyword;
    public $email;
    public $phone;
    public $name;
    public $address_detail;
    public $user_email;
    public $user_phone;
    public $start_date;
    public $end_date;
    public $start_price;
    public $end_price;
    public $room_type;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tb_booking';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, room_address_id, check_in, check_out, number_of_guests, room_price, cleaning_fees,
			    total_amount, payment_method', 'required'),
            array('user_id, room_address_id, number_of_guests, total_amount, payment_status, booking_status, del_flg,
                sent_to_adpia',
                'numerical', 'integerOnly' => true),
            array('room_price, cleaning_fees, additional_guests, price_additional_guests, discount', 'numerical'),
            array('check_in, check_out, coupon_code, payment_method', 'length', 'max' => 255),
            array('time_check_in, time_check_out, invoice_date, refund_date, created, updated, note', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, room_address_id, time_check_in, time_check_out, check_in, check_out, number_of_guests, room_price, cleaning_fees,
			    additional_guests, coupon_code, discount, total_amount, payment_method, payment_status, booking_status, invoice_date, refund_date, created,
			    updated, del_flg, price_additional_guests, email, name, address_detail, user_email, user_phone, start_date,
			    end_date, start_price, end_price, phone, room_type, sent_to_adpia',
                'safe', 'on' => 'search'),
            array('coupon_code', 'checkCoupon'),
        );
    }

    /**
     * check if isset coupon code
     *
     * @param $attribute_name
     * @param $params
     * @return bool
     */
    public function checkCoupon($attribute_name, $params)
    {
        if (!empty($this->$attribute_name)) {
            //check coupon code
            $couponMode = Coupon::getCouponByCode($this->$attribute_name);
            if (!$couponMode) {
                $this->addError($attribute_name, Yii::t('app', "{attribute_name} không tồn tại.", array(
                    '{attribute_name}' => self::getAttributeLabel($attribute_name)
                )));
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
            'BookingHistory' => array(self::HAS_ONE, 'BookingHistory', 'booking_id'),
            'BookingPayment' => array(self::HAS_ONE, 'BookingPayment', 'booking_id'),
            'BookingUser' => array(self::HAS_ONE, 'BookingUser', 'booking_id'),// Clone thong tin user dat phong
            'BookingUserDetail' => array(self::BELONGS_TO, 'Users', 'user_id'), // Thong tin chi tiet cua user dat phong
            'RoomAddress' => array(self::BELONGS_TO, 'RoomAddress', 'room_address_id', 'with'=>'Users'), // Thong tin Phong duoc dat va thong tin chu phong
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'room_address_id' => 'Room Address',
            'check_in' => Yii::t('app', 'Ngày đến'),
            'check_out' => Yii::t('app', 'Ngày đi'),
            'number_of_guests' => Yii::t('app', 'Số khách'),
            'room_price' => Yii::t('app', 'Giá'),
            'cleaning_fees' => Yii::t('app', 'Phí dọn dẹp'),
            'additional_guests' => Yii::t('app', 'Số khách thêm'),
            'price_additional_guests' => Yii::t('app', 'Giá cho khách thêm'),
            'coupon_code' => Yii::t('app', 'Mã khuyến mãi'),
            'discount' => Yii::t('app', 'Chiết khấu'),
            'total_amount' => Yii::t('app', 'Tổng tiền'),
            'payment_method' => Yii::t('app', 'Phương thức thanh toán'),
            'payment_status' => Yii::t('app', 'Trạng thái thanh toán'),
            'booking_status' => Yii::t('app', 'Trạng thái'),
            'invoice_date' => Yii::t('app', 'Ngày thanh toán'),
            'refund_date' => Yii::t('app', 'Ngày hủy'),
            'created' => 'Created',
            'updated' => 'Updated',
            'del_flg' => 'Del Flg',
            'name' => 'Tên phòng',
            'address_detail' => 'Địa chỉ phòng',
            'email' => 'Email của người đặt phòng',
            'phone' => 'Số điện thoại của người đặt phòng',
            'user_email' => 'Email của chủ nhà',
            'user_phone' => 'Số điện thoại của chủ nhà',
            'note' => 'Ghi chú',
            'keyword' => 'Từ khóa',
            'start_date' => 'Từ ngày',
            'end_date' => 'Đến ngày',
            'start_price' => 'Giá từ',
            'end_price' => 'Giá đến',
            'room_type' => 'Loại phòng'
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
        $criteria = new CDbCriteria;
        $criteria->with = array('BookingUser', 'BookingHistory', 'RoomAddress');
        $criteria->compare('t.del_flg', Constant::DEL_FALSE);

        if (!isset($this->keyword)) {
            $criteria->compare('id', $this->id);
            $criteria->compare('user_id', $this->user_id);
            $criteria->compare('room_address_id', $this->room_address_id);
            $criteria->compare('check_in', $this->check_in, true);
            $criteria->compare('check_out', $this->check_out, true);
            $criteria->compare('number_of_guests', $this->number_of_guests);
            $criteria->compare('room_price', $this->room_price);
            $criteria->compare('cleaning_fees', $this->cleaning_fees);
            $criteria->compare('coupon_code', $this->coupon_code, true);
            $criteria->compare('discount', $this->discount);
            $criteria->compare('total_amount', $this->total_amount);
            $criteria->compare('payment_method', $this->payment_method, true);
            $criteria->compare('payment_status', $this->payment_status);
            $criteria->compare('booking_status', $this->booking_status);
            $criteria->compare('invoice_date', $this->invoice_date, true);
            $criteria->compare('refund_date', $this->refund_date, true);
            $criteria->compare('created', $this->created, true);
            $criteria->compare('updated', $this->updated, true);
            $criteria->compare('BookingUser.email', $this->email, true);
            $criteria->compare('BookingHistory.room_name', $this->name, true);
            $criteria->compare('BookingHistory.room_address_detail', $this->address_detail, true);
        } else {
            $criteria->compare('id', $this->keyword, true, 'OR');
            $criteria->compare('check_in', $this->keyword, true, 'OR');
            $criteria->compare('check_out', $this->keyword, true, 'OR');
            $criteria->compare('room_price', $this->keyword, 'OR');
            $criteria->compare('total_amount', $this->keyword, 'OR');
            $criteria->compare('payment_method', $this->keyword, true, 'OR');
            $criteria->compare('invoice_date', $this->keyword, true, 'OR');
            $criteria->compare('refund_date', $this->keyword, true, 'OR');
            $criteria->compare('created', $this->keyword, true, 'OR');
            $criteria->compare('updated', $this->keyword, true, 'OR');
            $criteria->compare('BookingUser.email', $this->keyword, true, 'OR');
            $criteria->compare('BookingHistory.room_name', $this->keyword, true, 'OR');
            $criteria->compare('BookingHistory.room_address_detail', $this->keyword, true, 'OR');
        }
        
        if ($this->start_date) {
            $criteria->addCondition("DATE_FORMAT(STR_TO_DATE(t.check_in, '%d-%m-%Y'), '%Y-%m-%d') >= :start_date");
            $criteria->params += array('start_date' => date('Y-m-d', strtotime($this->start_date)));
        }
        
        if ($this->end_date) {
            $criteria->addCondition("DATE_FORMAT(STR_TO_DATE(t.check_out, '%d-%m-%Y'), '%Y-%m-%d') <= :end_date");
            $criteria->params += array('end_date' => date('Y-m-d', strtotime($this->end_date)));
        }
        
        if ($this->start_price) {
            $criteria->addCondition("t.total_amount >= :start_price");
            $criteria->params += array('start_price' => $this->start_price);
        }
        
        if ($this->end_price) {
            $criteria->addCondition("t.total_amount <= :end_price");
            $criteria->params += array('end_price' => $this->end_price);
        }
        
        if ($this->room_type) {
            $criteria->compare('RoomAddress.room_type', $this->room_type, true);
        }
        
        $sort = new CSort;
        $sort->attributes = array(
            '*',
            'email' => array(
                'asc' => 'BookingUser.email ASC',
                'desc' => 'BookingUser.email DESC',
            ),
            'phone' => array(
                'asc' => 'BookingUser.phone_number ASC',
                'desc' => 'BookingUser.phone_number DESC',
            ),
            'name' => array(
                'asc' => 'BookingHistory.room_name ASC',
                'desc' => 'BookingHistory.room_name DESC',
            ),
            'address_detail' => array(
                'asc' => 'BookingHistory.room_address_detail ASC',
                'desc' => 'BookingHistory.room_address_detail DESC',
            ),
        );
        $sort->defaultOrder = 't.id desc';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => $sort
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Booking the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return bool
     */
    public function beforeSave()
    {
        $now = new CDbExpression('NOW()');
        if ($this->isNewRecord) {
            $this->created = $now;
        }
        $this->updated = $now;

        if($this->sent_to_adpia==0 && $this->payment_status==Self::STATUS_PAID && !$this->isNewRecord){
            //sent to adpia
            $cartData = array(
                array(
                    'product_code' => '#'.$this->room_address_id.'-'.$this->user_id, //#RoomID-USERID
                    'item_count' => $this->number_of_guests,
                    'category_code' => 'Booking Shareroom',
                    'price' => $this->total_amount,
                    'product_name' => $this->BookingHistory->room_name,
                )
            );
            $order_code = '#'.$this->id;
            $id = 'shareroom';
            $name = 'Mac Ngoc Tuan';

            ADPia::adpia_cps($cartData, $order_code, $id, $name);

            $this->sent_to_adpia==1;
        }
        return parent::beforeSave();
    }

    public function afterSave()
    {
        if ($this->discount) {
            $couponModel = Coupon::getCouponByCode($this->coupon_code);

            if ($couponModel->coupon_uses) {
                $couponModel->coupon_uses = $couponModel->coupon_uses + 1;
            } else {
                $couponModel->coupon_uses = 1;
            }
            $couponModel->save();
        }

        return parent::afterSave();
    }

    public static function _getPaymentMethod($method = null)
    {
        $result = array(
            //self::PAYMENT_METHOD_SMARTLINK => Yii::t('app', 'Thanh toán bằng smartlink'),
            self::PAYMENT_METHOD_BANK_TRANFER => Yii::t('app', 'Thanh toán chuyển khoản'),
            self::PAYMENT_METHOD_COMPANY => Yii::t('app', 'Thanh toán tại văn phòng'),
        );
        return !empty($result[$method]) ? $result[$method] : $result;
    }

    public static function _getStatus($method = null)
    {
        $result = array(
            self::STATUS_UNPAID => Yii::t('app', 'Chưa thanh toán'),
            self::STATUS_PAID => Yii::t('app', 'Đã thanh toán'),
            self::STATUS_FAILS => Yii::t('app', 'Thanh toán lỗi'),
            self::STATUS_CANCEL => Yii::t('app', 'Đã từ chối'),
        );
        return !empty($result[$method]) ? $result[$method] : $result;
    }
    
    public static function _getStatusAdmin($method = null)
    {
        $result = array(
                self::STATUS_UNPAID => Yii::t('app', 'Chưa thanh toán'),
                self::STATUS_PAID => Yii::t('app', 'Đã thanh toán'),
                self::STATUS_FAILS => Yii::t('app', 'Thanh toán lỗi'),
                self::STATUS_CANCEL => Yii::t('app', 'Đã từ chối'),
                self::STATUS_PAID_USER => Yii::t('app', 'Đã thanh toán cho chủ phòng'),
        );
        return !empty($result[$method]) ? $result[$method] : $result;
    }

    public static function _getBookingStatus($method = null)
    {
        $result = array(
            self::BOOKING_STATUS_PENDING => Yii::t('app', 'Đang chờ'),
            self::BOOKING_STATUS_UNACCEPT => Yii::t('app', 'Đã từ chối'),
            self::BOOKING_STATUS_ACCEPT => Yii::t('app', 'Đã chấp nhận'),
            self::BOOKING_STATUS_USER_CANCEL => Yii::t('app', 'Khách hủy'),
        );
        return !empty($result[$method]) ? $result[$method] : $result;
    }

    /**
     * @deprecated: Khong con su dung Thay the bang function ben RoomSet
     * @param $room_address_id
     * @return array
     */
    public static function getDateBookingByRoomAddress($room_address_id)
    {
        $listDate = array();
        $criteria = new CDbCriteria();
        $criteria->compare('del_flg', Constant::DEL_FALSE);
        $criteria->compare('room_address_id', $room_address_id);
        $criteria->addInCondition('booking_status', array(
            Booking::BOOKING_STATUS_ACCEPT,
            Booking::BOOKING_STATUS_PENDING
        ));
        $listBookingModel = Booking::model()->findAll($criteria);
        if ($listBookingModel) {
            foreach ($listBookingModel as $booking) {
                $checkin = date('Y-m-d', strtotime($booking->check_in));
                $checkiout = date('Y-m-d', strtotime($booking->check_out));
                $arrr = Common::createDateRangeArray($checkin, $checkiout);
                $listDate = array_merge($listDate, $arrr);
            }
        }
        return $listDate;
    }
}