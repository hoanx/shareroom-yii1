<?php

/**
 * This is the model class for table "tb_coupon".
 *
 * The followings are the available columns in table 'tb_coupon':
 * @property integer $id
 * @property string $coupon_code
 * @property integer $discount_amount_percent
 * @property string $period
 * @property integer $coupon_uses
 * @property string $created
 * @property string $updated
 * @property integer $del_flg
 */
class Coupon extends CActiveRecord
{
    /**
     * @var keyword search
     */
    public $keyword;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_coupon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('coupon_code', 'unique'),
			array('coupon_code, discount_amount_percent', 'required'),
			array('discount_amount_percent, coupon_uses', 'numerical', 'integerOnly'=>true),
			array('coupon_code', 'length', 'max'=>Constant::COUPON_LENGHT),
			array('period, created, updated, keyword', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, coupon_code, discount_amount_percent, period, coupon_uses, created, updated, del_flg, keyword', 'safe', 'on'=>'search'),
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
			'coupon_code' => Yii::t('app', 'Mã khuyến mãi'),
			'discount_amount_percent' => Yii::t('app', 'Khuyến mãi'),
			'period' => Yii::t('app', 'Thời hạn đến ngày'),
			'coupon_uses' => Yii::t('app', 'Số lần sử dụng'),
			'created' => Yii::t('app', 'Ngày tạo'),
			'updated' => Yii::t('app', 'Ngày sửa'),
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
        $criteria->compare('del_flg',Constant::DEL_FALSE);

        if (!isset($this->keyword)) {
            $criteria->compare('id',$this->id);
            $criteria->compare('coupon_code',$this->coupon_code,true);
            $criteria->compare('discount_amount_percent',$this->discount_amount_percent);
            $criteria->compare('period',$this->period,true);
            $criteria->compare('coupon_uses',$this->coupon_uses);
            $criteria->compare('created',$this->created,true);
            $criteria->compare('updated',$this->updated,true);

        }else{
            $criteria->compare('id',$this->keyword,true);
            $criteria->compare('coupon_code',$this->keyword,true, 'OR');
            $criteria->compare('discount_amount_percent',$this->keyword,true, 'OR');
            $criteria->compare('period',$this->keyword,true, 'OR');
            $criteria->compare('coupon_uses',$this->keyword,true, 'OR');
            $criteria->compare('created',$this->keyword,true, 'OR');
            $criteria->compare('updated',$this->keyword,true, 'OR');
        }


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Coupon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave() {
        $now = new CDbExpression('NOW()');

        if(!$this->period) $this->period = null;

        if ($this->isNewRecord){
            $this->created = $now;
        }
        $this->updated = $now;
        return parent::beforeSave();
    }

    public static function generateCouponCode($lenght = Constant::COUPON_LENGHT){
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $res = "";
        for ($i = 0; $i < $lenght; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars)-1)];
        }

        return $res;
    }

    public static function getCouponByCode($coupon_code){
        $criteria = new CDbCriteria();
        $criteria->compare('coupon_code',$coupon_code);
        $criteria->compare('del_flg',Constant::DEL_FALSE);
        $now = new CDbExpression("NOW()");
        $criteria->addCondition('period > '.$now);
        $criteria->addCondition('period IS NULL', 'OR');

        return self::model()->find($criteria);
    }
}
