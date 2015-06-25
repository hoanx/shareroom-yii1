<?php

/**
 * This is the model class for table "tb_messages".
 *
 * The followings are the available columns in table 'tb_messages':
 * @property integer $id
 * @property integer $message_type
 * @property integer $to_user_id
 * @property integer $from_user_id
 * @property string $from_user_fisrt_name
 * @property string $from_user_last_name
 * @property string $start_date
 * @property string $end_date
 * @property integer $qty_guests
 * @property string $content
 * @property integer $status_flg
 * @property string $created
 * @property string $updated
 * @property string $del_flg
 */
class Messages extends CActiveRecord
{
    const MESSAGE_DEFAULT = 0;
    const MESSAGE_BOOKING = 1;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('to_user_id, from_user_id, from_user_fisrt_name, from_user_last_name, start_date, end_date, qty_guests, content', 'required'),
			array('message_type, to_user_id, from_user_id, qty_guests, status_flg', 'numerical', 'integerOnly'=>true),
			array('from_user_fisrt_name, from_user_last_name, del_flg', 'length', 'max'=>255),
			array('created, updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, message_type, to_user_id, from_user_id, from_user_fisrt_name, from_user_last_name, start_date, end_date, qty_guests, content, status_flg, created, updated, del_flg', 'safe', 'on'=>'search'),
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
			'message_type' => 'Loại tin nhắn',
			'to_user_id' => 'Tới',
			'from_user_id' => 'Từ',
			'from_user_fisrt_name' => 'Tên người gửi',
			'from_user_last_name' => 'Họ người gửi',
			'start_date' => 'Ngày đến',
			'end_date' => 'Ngày về',
			'qty_guests' => 'Số khách',
			'content' => 'Nội dung',
			'status_flg' => 'Trạng thái',
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
		$criteria->compare('message_type',$this->message_type);
		$criteria->compare('to_user_id',$this->to_user_id);
		$criteria->compare('from_user_id',$this->from_user_id);
		$criteria->compare('from_user_fisrt_name',$this->from_user_fisrt_name,true);
		$criteria->compare('from_user_last_name',$this->from_user_last_name,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('qty_guests',$this->qty_guests);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status_flg',$this->status_flg);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('del_flg',$this->del_flg,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Messages the static model class
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
