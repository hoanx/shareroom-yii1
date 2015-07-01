<?php

/**
 * This is the model class for table "tb_messages".
 *
 * The followings are the available columns in table 'tb_messages':
 * @property integer $id
 * @property integer $message_type
 * @property integer $from_user_id
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
    
    const STATUS_WAITING = 1;
    const STATUS_ACCEPT = 2;
    const STATUS_DENY = 3;
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
			array('conversation_id, from_user_id, to_user_id', 'required'),
			array('message_type, from_user_id, status_flg', 'numerical', 'integerOnly'=>true),
			array('del_flg', 'length', 'max'=>255),
			array('created, updated, content, read_flg', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, conversation_id, message_type, from_user_id, content, status_flg, created, updated, del_flg', 'safe', 'on'=>'search'),
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
	        'Users' => array(self::BELONGS_TO, 'Users', 'from_user_id'),
	        'Conversation' => array(self::BELONGS_TO, 'Conversation', 'conversation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
	        'conversation_id' => 'Conversation',
			'message_type' => 'Loại tin nhắn',
			'from_user_id' => 'Từ',
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
		$criteria->compare('conversation_id',$this->conversation_id);
		$criteria->compare('message_type',$this->message_type);
		$criteria->compare('from_user_id',$this->from_user_id);
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
    
    public static function getNotificationMail($id) {
        $count = Messages::model()->countByAttributes(array(
                'to_user_id'=> $id,
                'read_flg' => 0 
        ));
        
        if($count) {
            return '<span class="notification-mail">' . $count . '</span>';
        } else {
            return null;
        }
    }
}
