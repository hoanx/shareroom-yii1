<?php

/**
 * This is the model class for table "tb_coupon".
 *
 * The followings are the available columns in table 'tb_coupon':
 * @property integer $id
 * @property string $coupon_code
 * @property integer $discount_amount
 * @property string $period
 * @property integer $coupon_uses
 * @property string $created
 * @property string $updated
 * @property integer $del_flg
 */
class Coupon extends CActiveRecord
{
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
			array('id, coupon_code, discount_amount', 'required'),
			array('id, discount_amount, coupon_uses, del_flg', 'numerical', 'integerOnly'=>true),
			array('coupon_code', 'length', 'max'=>255),
			array('period, created, updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, coupon_code, discount_amount, period, coupon_uses, created, updated, del_flg', 'safe', 'on'=>'search'),
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
			'coupon_code' => 'Coupon Code',
			'discount_amount' => 'Discount Amount',
			'period' => 'Period',
			'coupon_uses' => 'Coupon Uses',
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
		$criteria->compare('coupon_code',$this->coupon_code,true);
		$criteria->compare('discount_amount',$this->discount_amount);
		$criteria->compare('period',$this->period,true);
		$criteria->compare('coupon_uses',$this->coupon_uses);
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
	 * @return Coupon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
