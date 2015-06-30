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

    const BOOKING_STATUS_PENDING = 1;
    const BOOKING_STATUS_UNACCEPT = 2;
    const BOOKING_STATUS_ACCEPT = 3;
    const BOOKING_STATUS_USER_CANCEL = 4;

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
			array('user_id, room_address_id, number_of_guests, total_amount, payment_status, booking_status, del_flg', 'numerical', 'integerOnly'=>true),
			array('room_price, cleaning_fees, discount', 'numerical'),
			array('check_in, check_out, coupon_code, payment_method', 'length', 'max'=>255),
			array('time_check_in, time_check_out, invoice_date, refund_date, created, updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, room_address_id, time_check_in, time_check_out, check_in, check_out, number_of_guests, room_price, cleaning_fees,
			    coupon_code, discount, total_amount, payment_method, payment_status, booking_status, invoice_date, refund_date, created,
			    updated, del_flg', 'safe', 'on'=>'search'),
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
            'BookingHistory' => array(self::HAS_ONE, 'BookingHistory', 'booking_id'),
            'BookingPayment' => array(self::HAS_ONE, 'BookingPayment', 'booking_id'),
            'BookingUser' => array(self::HAS_ONE, 'BookingUser', 'booking_id'),
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
			'coupon_code' => Yii::t('app', 'Mã giảm giá'),
			'discount' => Yii::t('app', 'Giảm giá'),
			'total_amount' => Yii::t('app', 'Tổng'),
			'payment_method' => Yii::t('app', 'Phương thức thanh toán'),
			'payment_status' => Yii::t('app', 'Trạng thái thanh toán'),
			'booking_status' => Yii::t('app', 'Trạng thái'),
			'invoice_date' => Yii::t('app', 'Ngày thanh toán'),
			'refund_date' => Yii::t('app', 'Ngày hủy'),
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
		$criteria->compare('room_address_id',$this->room_address_id);
		$criteria->compare('check_in',$this->check_in,true);
		$criteria->compare('check_out',$this->check_out,true);
		$criteria->compare('number_of_guests',$this->number_of_guests);
		$criteria->compare('room_price',$this->room_price);
		$criteria->compare('cleaning_fees',$this->cleaning_fees);
		$criteria->compare('coupon_code',$this->coupon_code,true);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('total_amount',$this->total_amount);
		$criteria->compare('payment_method',$this->payment_method,true);
		$criteria->compare('payment_status',$this->payment_status);
		$criteria->compare('invoice_date',$this->invoice_date,true);
		$criteria->compare('refund_date',$this->refund_date,true);
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
	 * @return Booking the static model class
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

    public static function _getPaymentMethod($method = null) {
        $result = array(
            self::PAYMENT_METHOD_SMARTLINK => Yii::t('app','Thanh toán bằng smartlink'),
            self::PAYMENT_METHOD_BANK_TRANFER => Yii::t('app','Thanh toán chuyển khoản'),
            self::PAYMENT_METHOD_COMPANY => Yii::t('app','Thanh toán tại văn phòng'),
        );
        return !empty($result[$method]) ? $result[$method] : $result;
    }

    public static function _getStatus($method = null) {
        $result = array(
            self::STATUS_UNPAID => Yii::t('app','Chưa thanh toán'),
            self::STATUS_PAID => Yii::t('app','Đã thanh toán'),
            self::STATUS_FAILS => Yii::t('app','Thanh toán lỗi'),
            self::STATUS_CANCEL => Yii::t('app','Đã từ chối'),
        );
        return !empty($result[$method]) ? $result[$method] : $result;
    }

    public static function _getBookingStatus($method = null) {
        $result = array(
            self::BOOKING_STATUS_PENDING => Yii::t('app','Đang chờ'),
            self::BOOKING_STATUS_UNACCEPT => Yii::t('app','Đã từ chối'),
            self::BOOKING_STATUS_ACCEPT => Yii::t('app','Đã chấp nhận'),
            self::BOOKING_STATUS_USER_CANCEL => Yii::t('app','Khách hủy'),
        );
        return !empty($result[$method]) ? $result[$method] : $result;
    }

    public static function getDateBookingByRoomAddress($room_address_id){
        $listDate = array();
        $criteria = new CDbCriteria();
        $criteria->compare('del_flg', Constant::DEL_FALSE);
        $criteria->compare('room_address_id', $room_address_id);
        $criteria->addInCondition('booking_status', array(
            Booking::BOOKING_STATUS_ACCEPT,
            Booking::BOOKING_STATUS_PENDING
        ));
        $listBookingModel = Booking::model()->findAll($criteria);
        if($listBookingModel){
            foreach($listBookingModel as $booking){
                $checkin = date('Y-m-d', strtotime($booking->check_in));
                $checkiout= date('Y-m-d', strtotime($booking->check_out));
                $arrr = Common::createDateRangeArray($checkin, $checkiout);
                $listDate = array_merge($listDate, $arrr);
            }
        }

        return $listDate;
    }
}
